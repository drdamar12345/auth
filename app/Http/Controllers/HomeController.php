<?php

namespace App\Http\Controllers;

use App\Models\UangMasuk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total = UangMasuk::where('store_id', $store)->get()->sum('nominal');
        $products = UangMasuk::where('store_id', $store)->get();
        return view('home', compact('products', 'total'));
    }
}
