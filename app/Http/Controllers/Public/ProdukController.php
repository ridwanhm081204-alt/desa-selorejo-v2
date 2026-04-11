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
}
