<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index() {
        $logs = \App\Models\ActivityLog::with('user')->orderBy('created_at', 'desc')->paginate(30);
        return view('admin.log.index', compact('logs'));
    }
}
