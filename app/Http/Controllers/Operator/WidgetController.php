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
        $heroValue = Setting::where('key', 'hero_kontak')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Hubungi Kami', 'subtitle' => 'Kami siap melayani dan mendengarkan aspirasi Anda.', 'icon' => 'phone-call'];
        return view('operator.widget.edit', compact('settings', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        Setting::updateOrCreate(
            ['key' => 'hero_kontak'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Kontak']);
        return back()->with('success', 'Banner header Kontak berhasil diperbarui!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|string|url|max:255',
            'instagram' => 'nullable|string|url|max:255',
            'youtube' => 'nullable|string|url|max:255',
            'tiktok' => 'nullable|string|url|max:255',
            'jam_kerja' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:16|regex:/^\+?[0-9]{8,15}$/',
            'whatsapp' => 'nullable|string|max:16|regex:/^\+?[0-9]{8,15}$/',
            'email' => 'nullable|email|max:255',
        ]);

        $allowed_keys = ['facebook', 'instagram', 'youtube', 'tiktok', 'jam_kerja', 'telepon', 'whatsapp', 'email'];
        foreach ($allowed_keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
            }
        }
        return back()->with('success', 'Widget & pengaturan kontak berhasil disimpan.');
    }
}
