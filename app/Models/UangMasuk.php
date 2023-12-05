<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangMasuk extends Model
{

    protected $table = 'tb_uang_masuk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nominal',
        'tanggal_pemasukan',
        'store_id',
        'qty',
        'note',
        'name_customer',
        'name_product',
        'updated_at',
        'created_at',
        'time',
        'size',
    ];
}

