<?php

namespace App\Http\Controllers;


use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function loginpage()
    {
        return view('Login.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/home')->with('OK', 'Login data authenticated !');
        } else {
            return redirect()->back()->with('ERR', 'Authentication failed !');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
