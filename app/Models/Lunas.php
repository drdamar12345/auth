<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lunas extends Model
{
    protected $table = 'tb_lunas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'store_id',
        'size',
        'harga',
        'status',
        'name_customer',
        'tanggal_pemesanan',
        'qty',
    ];
}
