<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends BaseController
{
    public function actionformstore(Request $request)
    {
        $user = Store::create([
            'name_store' => $request->name_store,
            'address' => $request->address,
            'name_owner' => $request->name_owner,
            'product_store' => $request->product_store,
        ]);
        
        return $this->sendResponse($user, 'Products retrieved successfully.');
    }

    public function daftarstore()
    {
        $user = auth()->user()->id;
        $stores = Store::all();
        return $this->sendResponse($stores, 'Products retrieved successfully.');
    }

    public function daftaradmin()
    {
        $admins = User::where('is_superadmin', ('admin'))->get();
        return $this->sendResponse($admins, 'Products retrieved successfully.');
    }

    public function actionid(Request $request)
    {
       $user = User::where('id', $request->id)
              ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'store_id' => $request->store_id]);
        return $this->sendResponse($user, 'Products retrieved successfully.');
    }
}
