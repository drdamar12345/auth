<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class LoginController extends BaseController
{
    public function login_action(Request $request)
    {
        // return $this->sendResponse($request->all(), 'User login successfully.');
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        } 

        else{ 

            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);

        } 
    }

    public function register_action(Request $request)

    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['email'] = ($input['email']);
        $input['name'] = ($input['name']);
        // $input['gambar'] = ($input['gambar']);

        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        // $success['gambar'] =  $user->gambar;
        

        return $this->sendResponse($success, 'User register successfully.');

    }
}
