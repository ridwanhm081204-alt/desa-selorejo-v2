<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        return view('admin.setting.index', compact('settings'));
    }

    public function update(\Illuminate\Http\Request $request) {
        $data = $request->except(['_token']);
        
        foreach($data as $key => $value) {
            if($request->hasFile($key)) {
                $value = $request->file($key)->store('settings', 'public');
            }
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Pengaturan Web']);
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
