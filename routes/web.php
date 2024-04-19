<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'log'])->name('/');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/reg', [AuthController::class, 'reg']);

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

    Route::get('/add-petugas', [AdminController::class, 'addPetugas'])->name('add_petugas');
    Route::post('/user/create', [AdminController::class, 'Userstore'])->name('user-store');
    Route::get('/getUser/{id}', [AdminController::class, 'getUser'])->name('getUser');
    Route::post('/user/update', [AdminController::class, 'Userupdate'])->name('user-update');
    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('user-delete');

    Route::get('/produk-admin', [ProdukController::class, 'index'])->name('produk-admin');
    Route::get('/produk/craate', [ProdukController::class, 'create'])->name('produk-create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk-store');
    Route::get('/produk-show/{id}', [ProdukController::class, 'show'])->name('produk-show');
    Route::get('/produk-edit/{id}', [ProdukController::class, 'edit'])->name('produk-edit');
    Route::put('/produk-restok/{id}', [ProdukController::class,'reStok'])->name('produk-restok');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk-update');
    Route::delete('/produk-delete/{id}', [ProdukController::class, 'delete'])->name('produk-delete');

    Route::get('/penjualan-admin', [PenjualanController::class, 'index'])->name('penjualan-admin');
    Route::get('/penjualan-admin/{id}/show', [DetailPenjualanController::class, 'show'])->name('admin-detail-penjualan');
    Route::get('/generate-pdf', [DetailPenjualanController::class, 'generatePDF'])->name('pdf-detail');
});

Route::group(['middleware' => 'role:petugas'], function () {
    Route::get('/petugas-dashboard', [PetugasController::class, 'index'])->name('petugas-dashboard');

    Route::get('/produk-petugas', [ProdukController::class, 'index'])->name('produk-petugas');
    Route::get('/produk-show-petugas/{id}', [ProdukController::class, 'show'])->name('produk-petugas-show');

    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
    Route::get('/penjualan/craate', [PenjualanController::class, 'create'])->name('penjualan-create');
    Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan-store');
    Route::get('/penjualan-petugas/{id}', [DetailPenjualanController::class, 'show'])->name('detail-penjualan-petugas');
    Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan-update');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'delete'])->name('penjualan-delete');
    Route::get('/generate-pdf', [DetailPenjualanController::class, 'generatePDF'])->name('pdf-detail');

});
