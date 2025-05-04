<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class accessController extends Controller
{
    public function showLogin()
    {
        return view('pages.access.login');
    }

    public function showRegister()
    {
        return view('pages.access.register');
    }

    public function showRegProv()
    {
        return view('pages.access.regProv');
    }
}
