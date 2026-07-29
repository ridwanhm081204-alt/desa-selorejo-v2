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

        // Hanya yang terverifikasi untuk peta (tanpa paginasi)
        $mapQuery = Umkm::where('status_lokasi', 'terverifikasi')
                        ->whereNotNull('latitude')
                        ->whereNotNull('longitude');

        // Terapkan filter yang sama ke peta
        if ($request->filled('search')) {
            $search = $request->search;
            $mapQuery->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('nama_pemilik', 'like', "%{$search}%")
                  ->orWhere('jenis_usaha', 'like', "%{$search}%")
                  ->orWhere('dusun', 'like', "%{$search}%");
            });
        }
        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $mapQuery->where('kategori', $request->kategori);
        }
        if ($request->filled('dusun') && $request->dusun !== 'semua') {
            $mapQuery->where('dusun', $request->dusun);
        }

        $umkmMap = $mapQuery->get()->map(fn($u) => [
            'id'            => $u->id,
            'nama_usaha'    => $u->nama_usaha,
            'nama_pemilik'  => $u->nama_pemilik,
            'jenis_usaha'   => $u->jenis_usaha,
            'kategori'      => $u->kategori,
            'dusun'         => $u->dusun,
            'alamat_rt_rw'  => $u->alamat_rt_rw,
            'no_telepon'    => $u->no_telepon,
            'wa_link'       => $u->whatsappLink(),
            'link_gmaps'    => $u->link_gmaps,
            'lat'           => $u->latitude,
            'lng'           => $u->longitude,
        ]);

        // Statistik ringkas
        $totalUmkm       = Umkm::count();
        $totalVerifikasi  = Umkm::where('status_lokasi', 'terverifikasi')->count();
        $totalBelum       = Umkm::where('status_lokasi', 'belum_terdaftar')->count();

        $mapsKey = ''; // tidak dipakai lagi, menggunakan Leaflet.js (gratis)

        return view('public.wisata.umkm', compact(
            'umkms',
            'umkmMap',
            'totalUmkm',
            'totalVerifikasi',
            'totalBelum'
        ));
    }
}
