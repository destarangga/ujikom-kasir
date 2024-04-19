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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        $product = new Produk();
        $product->nama_produk = $request->nama_produk;
        $product->harga = $request->harga;
        $product->stok = $request->stok;

        // Proses unggah gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image);
            $base64Image = base64_encode($imageData);
            $product->image = $base64Image; // Simpan data biner gambar
        }

        $product->save();

        return redirect()->route('produk-admin')->with('success', 'Product added successfully.');
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
        ]);

        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk-admin')->with('error', 'Produk not found');
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);

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
        $delete = $produk->delete();

        if ($delete) {
            return redirect()->route('produk-admin')->with('delete', 'Kegiatan mingguan berhasil dihapus');
        } else {
            return redirect()->route('produk-admin')->with('gagal', 'Kegiatan Mingguan failed');
        }
    }
}

