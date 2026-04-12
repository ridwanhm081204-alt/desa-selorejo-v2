<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikPenduduk;

class StatistikController extends Controller
{
    public function index()
    {
        $statistik = StatistikPenduduk::orderBy('tahun', 'desc')->orderBy('jenis_data')->get();
        return view('operator.statistik.index', compact('statistik'));
    }

    public function create()
    {
        return view('operator.statistik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun'      => 'required|integer|min:2000|max:2099',
            'jenis_data' => 'required|string|max:100',
            'label'      => 'required|string|max:100',
            'nilai'      => 'required|integer|min:0',
        ]);

        StatistikPenduduk::create($request->only(['tahun','jenis_data','label','nilai']));
        return redirect()->route('operator.statistik.index')->with('success', 'Data statistik berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $item = StatistikPenduduk::findOrFail($id);
        return view('operator.statistik.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tahun'      => 'required|integer|min:2000|max:2099',
            'jenis_data' => 'required|string|max:100',
            'label'      => 'required|string|max:100',
            'nilai'      => 'required|integer|min:0',
        ]);

        $item = StatistikPenduduk::findOrFail($id);
        $item->update($request->only(['tahun','jenis_data','label','nilai']));
        return redirect()->route('operator.statistik.index')->with('success', 'Data statistik berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        StatistikPenduduk::findOrFail($id)->delete();
        return back()->with('success', 'Data statistik berhasil dihapus.');
    }
}
