<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index() {
        $pesan = \App\Models\KontakMessage::orderByRaw("CASE WHEN status_baca = 'belum' THEN 1 ELSE 2 END")
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('operator.pesan.index', compact('pesan'));
    }

    public function show($id) {
        $pesan = \App\Models\KontakMessage::findOrFail($id);
        if ($pesan->status_baca == 'belum') {
            $pesan->update(['status_baca' => 'sudah']);
        }
        return view('operator.pesan.show', compact('pesan'));
    }
}
