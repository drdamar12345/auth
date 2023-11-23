<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'tb_size';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_product',
        'size',
        'stok',
        'status',
        'store_id',
        'price',
    ];
}
