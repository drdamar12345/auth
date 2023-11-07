<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'tb_purchase_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_product',
        'store_id',
        'purchase_id',
        'size',
        'qty',
        'harga',
        'status',
        'nama_product',
        'tanggal_pemesanan',
    ];
}
