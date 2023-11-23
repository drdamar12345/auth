<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_product_utama';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_product',
        'merk',
        'warna',
        // 'harga',
        'gambar',
        'keterangan',
        'store_id',
    ];
}
