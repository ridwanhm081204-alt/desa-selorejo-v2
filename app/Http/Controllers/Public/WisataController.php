<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index() {
        return view('public.wisata.index', ['wisata' => \App\Models\Wisata::all()]);
    }
}
