<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'tb_customer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'umur',
        'gender',
        'alamat',
        'tanggal_lahir',
        'status',
        'store_id',
    ];

}
