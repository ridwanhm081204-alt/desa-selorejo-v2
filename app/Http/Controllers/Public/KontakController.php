<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index() {
        $heroValue = \App\Models\Setting::where('key', 'hero_kontak')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Hubungi Kami', 'subtitle' => 'Kami siap melayani dan mendengarkan aspirasi Anda.', 'icon' => 'phone-call'];
        return view('public.kontak.index', compact('hero'));
    }

    public function store(\Illuminate\Http\Request $request) {
        // Throttle: maksimal 5 pesan per 5 menit per IP — cegah spam
        $key = 'kontak_' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
            return back()->withErrors(['pesan' => "Terlalu banyak pesan terkirim. Silakan tunggu {$seconds} detik."]);
        }
        \Illuminate\Support\Facades\RateLimiter::hit($key, 300); // 5 menit

        $data = $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'pesan' => 'required|string|min:10|max:2000',
        ]);

        // Simpan juga IP address untuk audit trail
        $data['ip_address'] = $request->ip();

        \App\Models\KontakMessage::create($data);
        return back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
