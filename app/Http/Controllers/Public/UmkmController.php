<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::query();

        // ─── Search ─────────────────────────────────────────────────────────────
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('nama_pemilik', 'like', "%{$search}%")
                  ->orWhere('jenis_usaha', 'like', "%{$search}%")
                  ->orWhere('dusun', 'like', "%{$search}%");
            });
        }

        // ─── Filter Kategori ─────────────────────────────────────────────────────
        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // ─── Filter Dusun ────────────────────────────────────────────────────────
        if ($request->filled('dusun') && $request->dusun !== 'semua') {
            $query->where('dusun', $request->dusun);
        }

        // ─── Sorting ──────────────────────────────────────────────────────────────
        $sort = $request->get('sort', 'nama_asc');
        match ($sort) {
            'dusun'    => $query->orderBy('dusun')->orderBy('nama_usaha'),
            'kategori' => $query->orderBy('kategori')->orderBy('nama_usaha'),
            default    => $query->orderBy('nama_usaha'),
        };

        // Semua UMKM untuk listing (paginasi)
        $umkms = $query->paginate(12)->withQueryString();

        // Statistik ringkas
        $totalUmkm = Umkm::count();

        return view('public.wisata.umkm', compact('umkms', 'totalUmkm'));
    }

    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);

        // Fetch related UMKMs (same dusun or same kategori)
        $relatedUmkms = Umkm::where('id', '!=', $umkm->id)
            ->where(function ($q) use ($umkm) {
                $q->where('dusun', $umkm->dusun)
                  ->orWhere('kategori', $umkm->kategori);
            })
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Custom pre-filled WhatsApp message
        $waBase = $umkm->whatsappLink();
        $waMessage = rawurlencode("Halo " . ($umkm->nama_pemilik ?: $umkm->nama_usaha) . ", saya melihat informasi usaha " . $umkm->nama_usaha . " di Portal Resmi Desa Selorejo. Saya ingin bertanya mengenai produk / layanan Anda.");
        $waLink = $waBase ? $waBase . "?text=" . $waMessage : null;

        return view('public.wisata.umkm-show', compact('umkm', 'relatedUmkms', 'waLink'));
    }
}
