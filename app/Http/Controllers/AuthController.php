<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function log(){
        return view('login');
    }

    public function authenticate(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin-dashboard');
            }elseif ($user->role === 'petugas') {
                return redirect()->route('petugas-dashboard');
            }
        } else {
            return redirect()->route('/')->with('failed', 'Email atau password salah');
        }
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('/')->with('logout', 'Berhasil Logout');
    }

    public function reg(){
        return view('register');
    }
}
