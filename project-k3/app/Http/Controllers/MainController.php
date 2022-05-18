<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class MainController extends Controller
{
    public function main()
    {
        //dd(Auth::user()->name);
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
