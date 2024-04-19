<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $totalPenjualan = Penjualan::count();
        $totalProduk = Produk::count();
        $totalUser = User::count();
        return view('admin.index', compact('totalPenjualan', 'totalProduk', 'totalUser'));
    }
}
