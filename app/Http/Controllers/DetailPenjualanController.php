<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Penjualan;
use Dompdf\Dompdf;



class DetailPenjualanController extends Controller
{
    public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $pelanggan = $penjualan->pelanggan;
        $penjualans = DetailPenjualan::with('produk')->where('penjualan_id', $id)->get();

        if (request()->ajax()) {
            return View::make('admin.penjualan.show', compact('penjualans', 'pelanggan'))->render();
        }

        return view('admin.penjualan.show', compact('penjualans', 'pelanggan'));
    }


    public function generatePDF($id)
    {
        // Fetch data for the specific penjualan
        $penjualan = Penjualan::findOrFail($id);
        $pelanggan = $penjualan->pelanggan;
        $penjualans = DetailPenjualan::with('produk')->where('penjualan_id', $id)->get();

        // Initialize Dompdf
        $dompdf = new Dompdf();

        // Load HTML content from Blade view
        $html = view('admin.penjualan.pdf', compact('penjualan', 'pelanggan', 'penjualans'))->render();

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generate)
        $dompdf->render();

        // Output PDF to browser
        return $dompdf->stream("penjualan_{$id}.pdf");
    }
}
