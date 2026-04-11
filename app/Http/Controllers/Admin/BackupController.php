<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
