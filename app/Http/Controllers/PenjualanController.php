<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(DetailPenjualan $details)
    {
        $penjualans = Penjualan::all();
        return view('admin.penjualan.index', compact('penjualans', 'details'));
    }

    public function create()
    {
        $products = Produk::all();
        return view('admin.penjualan.tambah', compact('products'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required',
        'alamat' => 'required',
        'no_tlp' => 'required',
        'tanggal_penjualan' => 'required',
        'produk_id' => 'required',
        'jumlah_produk' => 'required',
    ]);

    // Membuat pelanggan
    $customer = Pelanggan::create([
        'nama_pelanggan' => $request->nama_pelanggan,
        'alamat' => $request->alamat,
        'no_tlp' => $request->no_tlp,
    ]);

    // Membuat penjualan
    $sale = Penjualan::create([
        'pelanggan_id' => $customer->pelanggan_id,
        'tanggal_penjualan' => $request->tanggal_penjualan,
        'total_harga' => 0, // Menetapkan nilai awal total harga
    ]);

    $totalPrice = 0;
    for ($i = 0; $i < count($request->produk_id); $i++) {
        $product = Produk::findOrFail($request->produk_id[$i]);
        $subtotal = $product->harga * $request->jumlah_produk[$i];
        $saleDetail = DetailPenjualan::create([
            'penjualan_id' => $sale->penjualan_id,
            'produk_id' => $request->produk_id[$i],
            'jumlah_produk' => $request->jumlah_produk[$i],
            'subtotal' => $subtotal,
        ]);

        $totalPrice += $subtotal;

        // Mengurangi stok
        $product->stok -= $request->jumlah_produk[$i];
        $product->save();
    }

    // Update total harga penjualan
    $sale->update(['total_harga' => $totalPrice]);

    // Redirect dengan pesan sukses
    return redirect()->route('penjualan')->with('success', 'Data penjualan berhasil disimpan.');
}

}
