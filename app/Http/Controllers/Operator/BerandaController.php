<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\TautanTerkait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    public function index()
    {
        $settings      = Setting::all()->pluck('value', 'key');
        $tautanTerkait = TautanTerkait::orderBy('id')->get();

        $slideshow    = [];
        $slideshowRaw = Setting::where('key', 'beranda_slideshow')->value('value');
        if ($slideshowRaw) {
            $slideshow = json_decode($slideshowRaw, true) ?: [];
        }

        return view('operator.beranda.index', compact('settings', 'tautanTerkait', 'slideshow'));
    }

    // ─── SLIDESHOW ───────────────────────────────────────────────────────────

    public function storeSlide(Request $request)
    {
        $request->validate(['slide_image' => 'required|image|max:2048']);

        $slideshowRaw = Setting::where('key', 'beranda_slideshow')->value('value');
        $slideshow    = $slideshowRaw ? (json_decode($slideshowRaw, true) ?: []) : [];

        $path        = $request->file('slide_image')->store('beranda-slideshow', 'public');
        $slideshow[] = ['path' => $path];

        Setting::updateOrCreate(['key' => 'beranda_slideshow'], ['value' => json_encode($slideshow)]);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Slide Beranda']);

        return back()->with('success', 'Slide berhasil ditambahkan!');
    }

    public function deleteSlide(Request $request)
    {
        $request->validate(['index' => 'required|integer|min:0']);

        $slideshowRaw = Setting::where('key', 'beranda_slideshow')->value('value');
        $slideshow    = $slideshowRaw ? (json_decode($slideshowRaw, true) ?: []) : [];

        $idx = (int) $request->index;
        if (isset($slideshow[$idx])) {
            Storage::disk('public')->delete($slideshow[$idx]['path']);
            array_splice($slideshow, $idx, 1);
        }

        Setting::updateOrCreate(['key' => 'beranda_slideshow'], ['value' => json_encode(array_values($slideshow))]);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Slide Beranda']);

        return back()->with('success', 'Slide berhasil dihapus!');
    }

    // ─── TAUTAN TERKAIT ──────────────────────────────────────────────────────

    public function storeTautan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'url'  => 'required|url|max:255',
        ]);

        TautanTerkait::create($request->only('nama', 'url'));
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Tambah Tautan Terkait: ' . $request->nama]);

        return back()->with('success', 'Tautan berhasil ditambahkan!');
    }

    public function updateTautan(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'url'  => 'required|url|max:255',
        ]);

        $tautan = TautanTerkait::findOrFail($id);
        $tautan->update($request->only('nama', 'url'));
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Tautan Terkait: ' . $request->nama]);

        return back()->with('success', 'Tautan berhasil diperbarui!');
    }

    public function destroyTautan($id)
    {
        $tautan = TautanTerkait::findOrFail($id);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Tautan Terkait: ' . $tautan->nama]);
        $tautan->delete();

        return back()->with('success', 'Tautan berhasil dihapus!');
    }
}

