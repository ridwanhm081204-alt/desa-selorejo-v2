<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Produk::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'harga_low') {
            $query->orderBy('harga', 'asc');
        } elseif ($sort == 'harga_high') {
            $query->orderBy('harga', 'desc');
        } elseif ($sort == 'nama_asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($sort == 'nama_desc') {
            $query->orderBy('nama', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $produk = $query->paginate(12)->withQueryString();

        $heroValue = \App\Models\Setting::where('key', 'hero_produk')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Katalog Produk Desa', 'subtitle' => 'Mendukung karya lokal dan UMKM Desa Selorejo', 'icon' => 'shopping-bag'];
        
        return view('public.produk.index', compact('produk', 'hero'));
    }
    public function show($id) {
        return view('public.produk.show', ['produk' => \App\Models\Produk::findOrFail($id)]);
    }

    public function checkout($id) {
        $produk = \App\Models\Produk::findOrFail($id);
        return view('public.produk.checkout', compact('produk'));
    }

    public function processCheckout(Request $request, $id) {
        $produk = \App\Models\Produk::findOrFail($id);
        
        $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $produk->stok,
            'nama_pemesan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'kode_pos' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        // Pengurangan Stok
        if ($produk->stok >= $request->jumlah) {
            $produk->stok -= $request->jumlah;
            $produk->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Pembelian Berhasil!',
                'data' => $request->all(),
                'produk' => $produk
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Stok tidak mencukupi!'
        ], 422);
    }
}
