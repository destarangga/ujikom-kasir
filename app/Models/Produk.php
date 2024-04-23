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
        'deskripsi' 
    ];

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'produk_id');
    }
}
