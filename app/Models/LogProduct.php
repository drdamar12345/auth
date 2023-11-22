<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogProduct extends Model
{
    protected $table = 'tb_log_product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_product',
        'name_admin',
        'time',
        'date',
        'qty',
        'price',
    ];
}
