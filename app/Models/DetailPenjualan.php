<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualans';
    protected $primaryKey = 'detail_id';
    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'jumlah_produk',
        'subtotal'
    ];

    public function penjualan(){
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'penjualan_id');
    }
    
    // public function pelanggan()
    // {
    //     return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    // }

    public function produk(){
        return $this->hasMany(produk::class, 'produk_id', 'produk_id');
    }
}
