<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PollingController extends Controller
{
    public function index() {
        $polling = \App\Models\Polling::orderBy('created_at', 'desc')->paginate(20);
        $heroValue = \App\Models\Setting::where('key', 'hero_polling')->value('value');
        $hero = $heroValue ? json_decode($heroValue, true) : ['title' => 'Jejak Pendapat', 'subtitle' => 'Suara Anda sangat berarti bagi kemajuan desa kami.', 'icon' => 'pie-chart'];
        return view('operator.polling.index', compact('polling', 'hero'));
    }

    public function updateHero(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'hero_polling'],
            ['value' => json_encode($request->only('title', 'subtitle', 'icon'))]
        );
        
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Settings Section Polling']);
        return back()->with('success', 'Header seksi Jejak Pendapat (Beranda) berhasil diperbarui!');
    }
    public function create() {
        return view('operator.polling.form');
    }
    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active' => 'required|boolean'
        ]);
        
        \App\Models\Polling::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Buat Polling Baru']);
        return redirect('/operator/polling')->with('success', 'Polling berhasil dibuat!');
    }

    public function edit($id) {
        $polling = \App\Models\Polling::findOrFail($id);
        return view('operator.polling.form', compact('polling'));
    }

    public function update(\Illuminate\Http\Request $request, $id) {
        $polling = \App\Models\Polling::findOrFail($id);
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active' => 'required|boolean'
        ]);
        
        $polling->update($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Update Data Polling']);
        return redirect('/operator/polling')->with('success', 'Polling berhasil diperbarui!');
    }
    public function hasil($id) {
        $polling = \App\Models\Polling::findOrFail($id);
        // Load votes grouped by pilihan
        $votes = \App\Models\PollingVote::where('polling_id', $id)
            ->selectRaw('pilihan, COUNT(*) as total')
            ->groupBy('pilihan')
            ->get()
            ->pluck('total', 'pilihan');
        $totalVotes = $votes->sum();
        return view('operator.polling.hasil', compact('polling', 'votes', 'totalVotes'));
    }

    public function destroy($id) {
        $polling = \App\Models\Polling::findOrFail($id);
        $polling->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Polling']);
        return back()->with('success', 'Polling dihapus!');
    }
}
