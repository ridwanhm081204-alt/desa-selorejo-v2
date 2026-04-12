<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class WidgetController extends Controller
{
    public function edit()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('operator.widget.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $allowed_keys = ['facebook', 'instagram', 'youtube', 'jam_kerja', 'telepon', 'whatsapp', 'email'];
        foreach ($allowed_keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
            }
        }
        return back()->with('success', 'Widget & pengaturan kontak berhasil disimpan.');
    }
}
