<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $produk = $query->paginate(10)->withQueryString();

        $heroValue = \App\Models\Setting::where('key', 'hero_produk')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Katalog Produk Desa', 'subtitle' => 'Mendukung karya lokal dan UMKM Desa Selorejo', 'icon' => 'shopping-bag'];
        
        return view('operator.produk.index', compact('produk', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_produk'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Header Produk']);
        return back()->with('success', 'Banner header Produk berhasil diperbarui!');
    }
    public function create() {
        return view('operator.produk.form');
    }
    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:50',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'whatsapp' => ['nullable', 'string', 'max:16', 'regex:/^\+?[0-9]{8,15}$/'],
            'link_shopee' => 'nullable|url|max:500',
            'link_tokopedia' => 'nullable|url|max:500',
            'link_marketplace_lainnya' => 'nullable|url|max:500',
            'gambar' => 'required|image|max:2048'
        ]);
        // Sanitasi deskripsi HTML: hapus tag berbahaya (script, iframe, dll)
        $allowedTags = '<p><br><b><i><strong><em><u><s><ul><ol><li><h2><h3><h4><h5><h6><a><img><blockquote><span><div>';
        $data['deskripsi'] = strip_tags($data['deskripsi'], $allowedTags);
        $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        \App\Models\Produk::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Menambahkan Produk: '.$data['nama']]);
        return redirect('/operator/produk')->with('success', 'Produk berhasil ditambahkan!');
    }
    public function edit($id) {
        return view('operator.produk.form', ['produk' => \App\Models\Produk::findOrFail($id)]);
    }
    public function update(\Illuminate\Http\Request $request, $id) {
        $produk = \App\Models\Produk::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:50',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'whatsapp' => ['nullable', 'string', 'max:16', 'regex:/^\+?[0-9]{8,15}$/'],
            'link_shopee' => 'nullable|url|max:500',
            'link_tokopedia' => 'nullable|url|max:500',
            'link_marketplace_lainnya' => 'nullable|url|max:500',
            'gambar' => 'nullable|image|max:2048'
        ]);
        // Sanitasi deskripsi HTML: hapus tag berbahaya (script, iframe, dll)
        $allowedTags = '<p><br><b><i><strong><em><u><s><ul><ol><li><h2><h3><h4><h5><h6><a><img><blockquote><span><div>';
        $data['deskripsi'] = strip_tags($data['deskripsi'], $allowedTags);
        if($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }
        $produk->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Produk: '.$data['nama']]);
        return redirect('/operator/produk')->with('success', 'Produk berhasil diupdate!');
    }
    public function destroy($id) {
        $produk = \App\Models\Produk::findOrFail($id);
        
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Produk']);
        return back()->with('success', 'Produk dihapus!');
    }

    public function transaksi() {
        $transaksis = \App\Models\ProdukTransaksi::with('produk')->orderBy('created_at', 'desc')->paginate(15);
        return view('operator.produk.transaksi', compact('transaksis'));
    }

    public function updateTransaksiStatus(\Illuminate\Http\Request $request, $id) {
        $transaksi = \App\Models\ProdukTransaksi::findOrFail($id);
        $request->validate([
            'status' => 'required|in:Pesanan Masuk,Sedang Dipacking,Dalam Perjalanan,Sudah Sampai Tujuan'
        ]);

        $oldStatus = $transaksi->status;
        $transaksi->update(['status' => $request->status]);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => "Update Status Transaksi #{$transaksi->id} dari {$oldStatus} ke {$request->status}"
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status transaksi berhasil diperbarui.'
        ]);
    }
}
