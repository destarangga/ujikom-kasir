<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        return view('admin.produk.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
        ]);

          // Proses unggah gambar
          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('/image/produk'), $file_name);
        }

        $product = new Produk();
        $product->nama_produk = $request->nama_produk;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->deskripsi = $request->deskripsi;
        $product->image = $file_name;

      

        $product->save();

        return redirect()->route('produk-admin')->with('create', 'Product added successfully.');
    }

    public function show(Request $request, $id)
    {
        $produk = Produk::find($id);
        return view('admin.produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required',
        'harga' => 'required',
        'stok' => 'required',
        'deskripsi' => 'required',
    ]);

    $produk = Produk::find($id);

    if (!$produk) {
        return redirect()->route('produk-admin')->with('error', 'Produk not found');
    }

    // Handle file upload if a new image is provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $file_name = time() .'.'. $image->getClientOriginalExtension();
        $image->move(public_path('/image/produk'), $file_name);

        // Delete the previous image file if it exists
        // if ($produk->image) {
        //     $previousImagePath = public_path('/image/produk/' . $produk->image);
        //     if (file_exists($previousImagePath)) {
        //         unlink($previousImagePath);
        //     }
        // }

        // Update the product's image attribute with the new file name
        // $produk->image = $file_name;
    }

    // Update other product details
    $produk->nama_produk = $request->nama_produk;
    $produk->harga = $request->harga;
    $produk->stok = $request->stok;
    $produk->deskripsi = $request->deskripsi;
    $produk->image = $file_name;

   

    // Save the updated product
    $produk->save();

    return redirect()->route('produk-admin')->with('update', 'Produk berhasil diperbarui');
}




    public function reStok(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required',
        ]);

        $produk = Produk::find($id);

        $produk->update([
            'stok' => $request->stok
        ]);

        return redirect()->route('produk-admin')->with('update', 'Produk berhasil diperbarui');
    }

    public function delete(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    // Cek apakah ada detail penjualan terkait dengan produk ini
    $detailPenjualans = $produk->detailPenjualans()->get();

    if ($detailPenjualans->isNotEmpty()) {
        // Jika ada detail penjualan terkait, hapus terlebih dahulu
        foreach ($detailPenjualans as $detailPenjualan) {
            $detailPenjualan->delete();
        }
    }

    // Sekarang produk bisa dihapus
    $delete = $produk->delete();

    if ($delete) {
        return redirect()->route('produk-admin')->with('delete', 'Produk berhasil dihapus');
    } else {
        return redirect()->route('produk-admin')->with('gagal', 'Gagal menghapus produk');
    }
}


}

