<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// use Dompdf\Dompdf;


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
        $kembalian = 0; // Nilai default untuk kembalian
        return view('admin.penjualan.tambah', compact('products', 'kembalian'));
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
        'bayar' => 'required|numeric|min:0', // Validasi jumlah bayar
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
        'total_harga' => 0, 
        'bayar' => $request->bayar,  
        'kembalian' => 0, 
    ]);
    // dd($request->$sale);

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

    // Hitung kembalian
    $kembalian = $request->bayar - $totalPrice;

    // Update kembalian penjualan
    $sale->update(['kembalian' => $kembalian]);

    // $dompdf= $this->generatePDF($sale->id);

    // Redirect dengan pesan sukses
    return redirect()->route('penjualan')->with('create', 'Data penjualan berhasil disimpan.');
}
    

// public function generatePDF($id)
// {
//     // Fetch data for the specific penjualan
//     $penjualan = Penjualan::findOrFail($id);
//     $pelanggan = $penjualan->pelanggan;
//     $penjualans = DetailPenjualan::with('produk')->where('penjualan_id', $id)->get();

//     // Check if penjualan, pelanggan, and penjualans are populated
//     if (!$penjualan || !$pelanggan || $penjualans->isEmpty()) {
//         return redirect()->route('penjualan')->with('error', 'Data penjualan tidak ditemukan.');
//     }

//     // Initialize Dompdf
//     $dompdf = new Dompdf();

//     // Load HTML content from Blade view
//     $html = view('admin.penjualan.pdf', compact('penjualan', 'pelanggan', 'penjualans'))->render();

//     // Check if HTML content is empty
//     if (empty($html)) {
//         return redirect()->route('penjualan')->with('error', 'HTML content is empty for PDF generation.');
//     }

//     // Load HTML to Dompdf
//     $dompdf->loadHtml($html);

//     // (Optional) Set paper size and orientation
//     $dompdf->setPaper('A4', 'portrait');

//     // Render PDF (generate)
//     $dompdf->render();

//     // Output PDF to browser
//     return $dompdf->stream("penjualan_{$id}.pdf");
// }
}
