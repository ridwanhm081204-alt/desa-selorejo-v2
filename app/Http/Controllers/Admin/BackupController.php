<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    /**
     * Ukuran maksimum file backup yang boleh diimpor (10 MB).
     */
    private const MAX_IMPORT_SIZE_KB = 10240;

    /**
     * MIME types yang valid untuk file SQLite.
     * SQLite biasanya terdeteksi sebagai application/octet-stream atau application/x-sqlite3.
     */
    private const VALID_SQLITE_MAGIC = "SQLite format 3";

    public function index()
    {
        return view('admin.backup.index');
    }

    public function backup()
    {
        // SQLite backup: copy file database
        $dbPath = database_path('database.sqlite');
        $backupName = 'backup_' . date('Y_m_d_H_i_s') . '.sqlite';
        $backupPath = storage_path('app/backup/' . $backupName);

        if (!file_exists(storage_path('app/backup'))) {
            mkdir(storage_path('app/backup'), 0755, true);
        }

        if (file_exists($dbPath)) {
            copy($dbPath, $backupPath);
            \App\Models\Setting::updateOrCreate(['key' => 'last_backup'], ['value' => now()->toDateTimeString()]);
            \App\Models\ActivityLog::create([
                'user_id'    => auth()->id(),
                'action'     => 'Melakukan Backup Database',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            return response()->download($backupPath)->deleteFileAfterSend(false);
        }

        return back()->with('error', 'Database file tidak ditemukan.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|max:' . self::MAX_IMPORT_SIZE_KB,
        ]);

        $file = $request->file('backup_file');

        // 1. Validasi ekstensi
        if ($file->getClientOriginalExtension() !== 'sqlite') {
            return back()->with('error', 'Format file tidak valid. Harap unggah file .sqlite');
        }

        // 2. Validasi magic bytes (signature SQLite) — cegah file disguised sebagai .sqlite
        $handle = fopen($file->getRealPath(), 'rb');
        $header = fread($handle, 15);
        fclose($handle);

        if ($header !== self::VALID_SQLITE_MAGIC) {
            Log::warning('Import database gagal: file bukan SQLite valid.', [
                'user_id'    => auth()->id(),
                'ip'         => $request->ip(),
                'filename'   => $file->getClientOriginalName(),
            ]);
            return back()->with('error', 'File yang diunggah bukan database SQLite yang valid.');
        }

        $dbPath = database_path('database.sqlite');

        // 3. Safety backup sebelum overwrite
        $safetyBackupName = 'safety_backup_before_import_' . date('Y_m_d_H_i_s') . '.sqlite';
        if (file_exists($dbPath)) {
            copy($dbPath, storage_path('app/backup/' . $safetyBackupName));
        }

        try {
            // 4. Ganti database
            $file->move(database_path(), 'database.sqlite');

            \App\Models\ActivityLog::create([
                'user_id'    => auth()->id(),
                'action'     => 'Melakukan Import Database (Database lama dicadangkan ke safety_backup)',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            return back()->with('success', 'Database berhasil dipulihkan! Anda mungkin perlu login kembali jika data user berubah.');
        } catch (\Exception $e) {
            // Log detail error ke server, tampilkan pesan generik ke user
            Log::error('Import database gagal.', [
                'user_id'    => auth()->id(),
                'ip'         => $request->ip(),
                'error'      => $e->getMessage(),
            ]);
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data. Silakan coba lagi atau hubungi administrator.');
        }
    }
}
