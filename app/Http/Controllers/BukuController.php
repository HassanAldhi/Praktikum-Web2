<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index(){
        $data_buku = Buku::all();
        $jumlah_buku = Buku::count();
        $total = Buku::sum('harga');

        return view('buku', compact('data_buku','jumlah_buku','total'));
    }
}
