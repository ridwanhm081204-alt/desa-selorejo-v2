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
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'pesan' => 'required|string',
        ]);
        
        \App\Models\KontakMessage::create($data);
        return back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
