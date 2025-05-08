<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
use Illuminate\Http\Request;

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
    public function cerrarSesion(Request $request)
    {
        Auth::logout(); // Cierra la sesión
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF
        return redirect()->route('home'); // Redirige al home
    }
}
