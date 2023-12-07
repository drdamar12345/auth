<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PattyCash extends Model
{
    protected $table = 'tb_log_patty_cash';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_admin',
        'nominal',
        'date',
        'store_id',
    ];
}
