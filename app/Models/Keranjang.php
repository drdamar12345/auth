<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'tb_keranjang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nama',
        'gambar',
        'harga',
        'id_product',
        'qty',
        'ukuransepatu',
        'store_id',
    ];
}
