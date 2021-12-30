<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd($request->all());
        $user = User::where('email', $request->email)->first();


        if($user == null){
            \Session::flash('err', 'Email Anda Salah');
            
            return redirect('/log');
        }

            
        if(\Hash::check($request->password, $user->password)){
            if ($user->role == 'customer') {
                \Session::put('user', $user);

                return redirect('/home');
            } if($user->role == 'admin'){

                \Session::put('user', $user);

                return redirect('/dashboard');
            }
            
        }else {
            \Session::flash('err', 'Password Salah!');
            
            return redirect('/log');
        }
        
        // dd($request->all());
    }

    public function addUser(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'no_hp' => 'required',
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'alamat' => '',
            'role' => 'customer',
            'no_hp' => '0'.$request->no_hp
        ]);

        \Session::flash('msg', 'Akun Berhasil Dibuat! Silahkan Login');
        
        return redirect('/log'); 
 
    }

    public function logout()
    {
        \Session::flush();

        return redirect('/');
    }

}
