<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    protected $table = 'produks';
    protected $primaryKey = 'produk_id';
    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'image', 
    ];

    public function detailPenjualan()
    {
        return $this->belongsTo(DetailPenjualan::class, 'produk_id', 'produk_id');
    }
}
