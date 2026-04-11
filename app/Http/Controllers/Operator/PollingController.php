<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PollingController extends Controller
{
    public function index() {
        return view('operator.polling.index', ['polling' => \App\Models\Polling::orderBy('tanggal_mulai', 'desc')->paginate(10)]);
    }
    public function create() {
        return view('operator.polling.create');
    }
    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active' => 'required|boolean'
        ]);
        
        if ($data['is_active']) {
            \App\Models\Polling::query()->update(['is_active' => false]);
        }
        
        \App\Models\Polling::create($data);
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Buat Polling Baru']);
        return redirect('/operator/polling')->with('success', 'Polling berhasil dibuat!');
    }
    public function destroy($id) {
        $polling = \App\Models\Polling::findOrFail($id);
        $polling->delete();
        \App\Models\ActivityLog::create(['user_id' => auth()->id(), 'action' => 'Hapus Polling']);
        return back()->with('success', 'Polling dihapus!');
    }
}
