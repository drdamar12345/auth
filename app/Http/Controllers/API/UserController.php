<?php

namespace App\Http\Controllers\API;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{
    public function profil()
    {
        $user = auth()->user()->id;
        $users = User::where('id', $user)->first();
        return $this->sendResponse($users, 'Products retrieved successfully.');
    }

    public function logout_action(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Berhasil logout']);
    }
}
