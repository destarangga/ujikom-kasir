<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $primaryKey = 'penjualan_id';
    protected $fillable = [
        'tanggal_penjualan',
        'total_harga',
        'pelanggan_id',
        'produk_id', // Menambahkan kolom produk_id ke dalam $fillable jika belum ada
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id', 'penjualan_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }
}

