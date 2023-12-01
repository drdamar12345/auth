<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UangMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register1()
    {
        return view('register1');
    }
    public function login1()
    {
        return view('login1');
    }
    public function Logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function home()
    {
        $store = auth()->user()->store_id;
        $total = UangMasuk::where('store_id', $store)->get()->sum('nominal');
        $products = UangMasuk::where('store_id', $store)->get();
        return view('home', compact('products', 'total'));
    }
    public function actionregister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_superadmin'=>'admin',
        ]);
        


        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan email dan password.');
        return redirect('register1');
    }
    public function login_action(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = auth()->user();
            // dd($user);
            if($user->is_superadmin == ('super_admin')){
                return redirect()->route('superadmin')->with('success','You are Logged in sucessfully.');
            }
            else {
                return redirect()->intended('/home');
            }
        }

        return back()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }
    public function ubahpassword()
    {
        return view('ubahpassword');
    }
    public function password_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }
    
}
