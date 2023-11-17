<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangKeluar extends Model
{
    protected $table = 'tb_uang_keluar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nominal',
        'tanggal_pengeluaran',
        'note',
        'store_id',
        'nama_admin',
        'nama_product',
        'qty',
        'total',
    ];
}
