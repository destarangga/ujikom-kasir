<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totalPenjualan = Penjualan::count();
        $totalProduk = Produk::count();
        $totalUser = User::count();
        return view('admin.index', compact('totalPenjualan', 'totalProduk', 'totalUser'));
    }

    public function addPetugas()
    {
        $users = User::all();
        return view('admin.add_petugas', compact('users'));
    }

    public function Userstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        $data = $request->except('confirm-password', 'password');
        $data['password'] = Hash::make(request()->input('password'));
        // dd($data);
        User::create($data);
        return redirect()->route('add_petugas')->with('success', 'Kegiatan mingguan berhasil ditambahkan');
    }

    public function getUser($id)
    {
        $users = User::find($id);
        return json_encode($users);
    }

    public function Userupdate(Request $request)
    {
        $karyawan = User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('add_petugas')->with('update', 'Kegiatan harian berhasil diperbarui');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $delete = $user->delete();

        if ($delete) {
            return redirect()->route('add_petugas')->with('delete', 'Kegiatan mingguan berhasil dihapus');
        } else {
            return redirect()->route('add_petugas')->with('gagal', 'Kegiatan Mingguan failed');
        }
    }
}
