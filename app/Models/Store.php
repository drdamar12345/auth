<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'tb_store';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_store',
        'address',
        'name_owner',
        'product_store',
    ];
}
