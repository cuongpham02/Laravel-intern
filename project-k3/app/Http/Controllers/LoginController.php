<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $email = $request->old('email');
    

        $remember_me = $request->has('remember') ? true : false; 
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('pswd')
        ], $remember_me)) {
            return redirect()->route('admin');
        }
        Session::flash('error', 'Email hoặc Password Không đúng');
        return redirect()->back();
    }
}