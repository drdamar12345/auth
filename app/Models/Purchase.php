<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'tb_purchase';
    protected $primaryKey = 'id';
    protected $fillable = [
        'store_id',
        'user_id',
        'total_harga',
        'tanggal_pemesanan',
    ];
}
