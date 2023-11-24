<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogProductDetail extends Model
{
    protected $table = 'log_product_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'store_id',
        'name_product',
        'price',
        'size',
        'qty',
        'name_admin',
        'time',
        'date',
        'note',
        'total',
    ];
}
