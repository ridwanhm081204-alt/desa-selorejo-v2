<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index() {
        return view('public.produk.index', ['produk' => \App\Models\Produk::paginate(12)]);
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
