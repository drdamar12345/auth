<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivityMasuk extends Model
{
    protected $table = 'log_uang_masuk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'store_id',
        'name_customer',
        'name_product',
        'name_admin',
        'jam',
        'tanggal',
        'total',
        'nominal',
    ];
}
