<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $jumlahOperator = \App\Models\User::where('role','operator')->count();
        $jumlahLog = \App\Models\ActivityLog::count();
        $lastBackup = \App\Models\Setting::get('last_backup', 'Belum pernah');
        return view('admin.dashboard', compact('jumlahOperator', 'jumlahLog', 'lastBackup'));
    }
}
