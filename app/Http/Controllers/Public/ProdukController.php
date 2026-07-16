<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\Produk::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
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
    public function show(Request $request, $id) {
        $produk = \App\Models\Produk::with(['reviews' => function($q) use ($request) {
            $sort = $request->get('review_sort', 'terbaru');
            if ($sort == 'rating_desc') $q->orderBy('rating', 'desc');
            elseif ($sort == 'rating_asc') $q->orderBy('rating', 'asc');
            elseif ($sort == 'terlama') $q->orderBy('created_at', 'asc');
            else $q->orderBy('created_at', 'desc'); // terbaru
        }])->findOrFail($id);

        return view('public.produk.show', compact('produk'));
    }

    public function checkout($id) {
        $produk = \App\Models\Produk::findOrFail($id);
        return view('public.produk.checkout', compact('produk'));
    }

    public function processCheckout(Request $request, $id) {
        $produk = \App\Models\Produk::findOrFail($id);
        
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1|max:' . $produk->stok,
            'nama_pemesan' => 'required|string|max:255',
            'telepon' => ['required', 'string', 'max:16', 'regex:/^\+?[0-9]{8,15}$/'],
            'alamat' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'kode_pos' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        // Simpan ke Database
        $transaksi = \App\Models\ProdukTransaksi::create(array_merge($validated, [
            'produk_id' => $produk->id,
            'total_harga' => $validated['jumlah'] * $produk->harga,
            'status' => 'Pesanan Masuk'
        ]));

        // Pengurangan Stok
        if ($produk->stok >= $request->jumlah) {
            $produk->stok -= $request->jumlah;
            $produk->save();
            
            $whatsappNumber = preg_replace('/[^0-9]/', '', $produk->whatsapp ?: \App\Models\Setting::get('whatsapp', ''));
            if (str_starts_with($whatsappNumber, '0')) {
                $whatsappNumber = '62' . substr($whatsappNumber, 1);
            }
            return response()->json([
                'success' => true,
                'message' => 'Pesanan Anda telah dicatat!',
                'whatsapp_url' => "https://wa.me/{$whatsappNumber}?text=" . urlencode("Halo Admin Toko Desa Selorejo,\n\nSaya ingin KONFIRMASI PESANAN dengan detail berikut:\n\n📦 *ID Transaksi:* #{$transaksi->id}\n🛍️ *Produk:* {$produk->nama}\n🔢 *Jumlah:* {$transaksi->jumlah} item\n💰 *Total Harga:* Rp " . number_format($transaksi->total_harga, 0, ',', '.') . "\n💳 *Metode Pembayaran:* {$transaksi->metode_pembayaran}\n\n👤 *Data Pemesan:*\nNama: {$transaksi->nama_pemesan}\nTelepon: {$transaksi->telepon}\n📍 *Alamat Pengiriman:*\n{$transaksi->alamat}, Kel. {$transaksi->kelurahan}, Kec. {$transaksi->kecamatan}, Kab. {$transaksi->kabupaten}, Kode Pos: {$transaksi->kode_pos}\n\nMohon segera diproses ya, terima kasih!"),
                'data' => $transaksi
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Stok tidak mencukupi!'
        ], 422);
    }

    public function storeReview(Request $request, $id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'saran' => 'required|string',
            'kritik' => 'required|string',
            'foto_produk' => 'required|image|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('reviews', 'public');
        }

        $produk->reviews()->create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'rating' => $request->rating,
            'saran' => $request->saran,
            'kritik' => $request->kritik,
            'foto_produk' => $fotoPath
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    public function share($id) {
        $produk = \App\Models\Produk::findOrFail($id);
        
        $sessionKey = 'shared_produk_' . $produk->id;
        if (session()->has($sessionKey)) {
            return response()->json(['success' => true, 'shares' => $produk->shares]);
        }

        $produk->increment('shares');
        session()->put($sessionKey, true);

        return response()->json(['success' => true, 'shares' => $produk->shares]);
    }
}
