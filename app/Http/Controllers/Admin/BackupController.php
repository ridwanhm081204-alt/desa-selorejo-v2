<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index() {
        return view('admin.backup.index');
    }

    public function backup() {
        // Since we are using sqlite, backup is just copying the sqlite file.
        $dbPath = database_path('database.sqlite');
        $backupName = 'backup_' . date('Y_m_d_H_i_s') . '.sqlite';
        $backupPath = storage_path('app/backup/' . $backupName);
        
        if (!file_exists(storage_path('app/backup'))) {
            mkdir(storage_path('app/backup'), 0755, true);
        }
        
        if (file_exists($dbPath)) {
            copy($dbPath, $backupPath);
            \App\Models\Setting::updateOrCreate(['key' => 'last_backup'], ['value' => now()->toDateTimeString()]);
            \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Melakukan Backup Database']);
            return response()->download($backupPath)->deleteFileAfterSend(false);
        }
        
        return back()->with('error', 'Database file tidak ditemukan.');
    }

    public function import(Request $request) {
        $request->validate([
            'backup_file' => 'required|file'
        ]);

        $file = $request->file('backup_file');
        
        // Basic extension check
        if ($file->getClientOriginalExtension() !== 'sqlite') {
            return back()->with('error', 'Format file tidak valid. Harap unggah file .sqlite');
        }

        $dbPath = database_path('database.sqlite');
        
        // Safety: Backup current database before overwriting
        $safetyBackupName = 'safety_backup_before_import_' . date('Y_m_d_H_i_s') . '.sqlite';
        if (file_exists($dbPath)) {
            copy($dbPath, storage_path('app/backup/' . $safetyBackupName));
        }

        try {
            // Replace current database
            $file->move(database_path(), 'database.sqlite');
            
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(), 
                'action' => 'Melakukan Import Database (Database lama dicadangkan ke safety_backup)'
            ]);

            return back()->with('success', 'Database berhasil dipulihkan! Anda mungkin perlu login kembali jika data user berubah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
