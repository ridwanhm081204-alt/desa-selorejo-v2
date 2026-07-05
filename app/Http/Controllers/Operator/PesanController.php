<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\KontakMessage::query();

        // Filter Status
        if ($request->filled('status')) {
            if ($request->status !== 'semua') {
                $query->where('status_baca', $request->status);
            }
        }

        // Sorting Logic
        $sort = $request->query('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'nama_asc':
                $query->orderBy('nama', 'asc');
                break;
            case 'nama_desc':
                $query->orderBy('nama', 'desc');
                break;
            case 'terbaru':
            default:
                // Default: Belum dibaca di atas, lalu terbaru
                $query->orderByRaw("CASE WHEN status_baca = 'belum' THEN 1 ELSE 2 END")
                      ->orderBy('created_at', 'desc');
                break;
        }

        $pesan = $query->paginate(20)->withQueryString();
        return view('operator.pesan.index', compact('pesan'));
    }

    public function show($id) {
        $pesan = \App\Models\KontakMessage::findOrFail($id);
        if ($pesan->status_baca == 'belum') {
            $pesan->update(['status_baca' => 'sudah']);
        }
        return view('operator.pesan.show', compact('pesan'));
    }

    public function baca($id) {
        $pesan = \App\Models\KontakMessage::findOrFail($id);
        $pesan->update(['status_baca' => 'sudah']);
        return response()->json(['success' => true, 'message' => 'Pesan ditandai sudah dibaca.']);
    }
}
