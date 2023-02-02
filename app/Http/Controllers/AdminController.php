<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        if(Auth::guard('admin')->attempt($data)){
            return redirect('/trangchu');
        }else{
            return redirect('/getlogin');
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/getlogin');
    }
}
