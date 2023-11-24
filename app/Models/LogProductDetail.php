<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogProductDetail extends Model
{
    protected $table = 'tb_log_product_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_product',
        'size',
        'price',
        'store_id',
        'qty',
        'name_admin',
        'date',
        'time',
        'note',
        'total',
    ];
}
