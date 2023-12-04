<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function addcustomer()
    {
        return view('addcustomer');
    }
    public function addnewcustomer(Request $request)
    {
        // dd($request->all());
        $user = auth()->user()->id;
        $admin = User::where('id', $user)->first();
        // dd($admin);
        $add=Customer::create([
            'nama'=>$request->nama,
            'umur'=>$request->umur,
            'gender'=>$request->gender,
            'alamat'=>$request->alamat,
            'alamat'=>$request->alamat,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'status'=>$request->status,
            'store_id'=>$admin->store_id,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
        ]);
        return redirect()->back()->with('success', 'Add New Product');

    }
    public function daftarcustomer()
    {
        $user = auth()->user()->store_id;
        $stores = Customer::where('store_id', $user)->get();;
        return view('daftarcustomer', compact('stores'));
    }
    public function editstatus($id)
    {
        $detail = Customer::find($id);
        return view('editstatus', compact('detail'));
    }
    public function actionstatus(Request $request)
    {
        Customer::where('id', $request->id)
              ->update(['status' => $request->status]);
        return redirect('/daftarcustomer');

    }
}
