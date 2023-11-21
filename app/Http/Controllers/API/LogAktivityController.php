<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UangMasuk;
use Illuminate\Http\Request;

class LogAktivityController extends BaseController
{
    public function aktivitymasuk()
    {
        $store = auth()->user()->store_id;
        // dd($daftar);
        $masuk = UangMasuk::where('store_id', $store)->get();
        $post = UangMasuk::leftJoin('tb_store', 'tb_store.id', 'tb_uang_masuk.store_id')
        ->select(
            'tb_uang_masuk.store_id',
            'tb_uang_masuk.name_customer',
            'tb_uang_masuk.name_product',
            'tb_uang_masuk.nominal',
            'tb_uang_masuk.tanggal_pemasukan',
            'tb_store.name_store',
            // lanjutkan kebawah untuk ambil data yang dibutuhkan
        )->where('tb_uang_masuk.store_id', $store)->get();
        // dd($post);
        return $this->sendResponse($post, 'Products retrieved successfully.');
    }
}
