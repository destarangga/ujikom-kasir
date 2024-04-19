<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Penjualan;
use Dompdf\Dompdf;



class DetailPenjualanController extends Controller
{
    public function show($id)
    {
        $penjualans = DetailPenjualan::with('produk')->where('penjualan_id', $id)->get();
        // $penjualans = Penjualan::with('pelanggan')->get();

        
        if(request()->ajax()) {
            // Jika request datang melalui AJAX, kirimkan tampilan partial dengan data penjualans
            return View::make('admin.penjualan.show', compact('penjualans'))->render();
        }

        // Jika bukan request AJAX, kirimkan tampilan lengkap
        return view('admin.penjualan.show', compact('penjualans'));
    }

    public function generatePDF()
{
    // Fetch data if needed (example)
    $penjualans = DetailPenjualan::all();

    // Initialize Dompdf
    $dompdf = new Dompdf();

    // Load HTML content from Blade view
    $html = view('admin.penjualan.pdf', compact('penjualans'))->render();

    // Load HTML to Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (generate)
    $dompdf->render();

    // Output PDF to browser
    return $dompdf->stream("example.pdf");
}
}
