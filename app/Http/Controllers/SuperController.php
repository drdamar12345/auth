<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperController extends Controller
{
    public function superadmin()
    {
        return view('superadmin');
    }
}
