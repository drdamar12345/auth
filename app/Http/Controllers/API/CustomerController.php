<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends BaseController
{
    public function addnewcustomer(Request $request)
    {
        $user = auth()->user()->id;
        $admin = User::where('id', $user)->first();
        $add = Customer::create([
            'nama'=>$request->nama,
            'umur'=>$request->umur,
            'gender'=>$request->gender,
            'alamat'=>$request->alamat,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'status'=>$request->status,
            'store_id'=>$admin->store_id,
        ]);
        return $this->sendResponse($add, 'Products retrieved successfully.');
    }

    public function daftarpelanggan()
    {
        $user = auth()->user()->store_id;
        $stores = Customer::select( 
            'tb_customer.nama',
            'tb_customer.gender',
            'tb_customer.alamat'

         )
         ->where('tb_customer.store_id', $user)->get();
        return $this->sendResponse($stores, 'Products retrieved successfully.');
    }

    public function actionstatuspelanggan(Request $request)
    {
       $pelanggan = Customer::where('id', $request->id)
              ->update(['status' => $request->status]);
        return $this->sendResponse($pelanggan, 'Products retrieved successfully.');
    }


    public function data_pembeli(Request $request)
    {
        $detail = Customer::where('id', $request->id)->get();
        return $this->sendResponse($detail, 'Products retrieved successfully.');
    }
}
