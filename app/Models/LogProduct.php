<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogProduct extends Model
{
    protected $table = 'log_product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'store_id',
        'name_product',
        'name_admin',
        'time',
        'date',
        'price',
        'qty',
    ];
}
