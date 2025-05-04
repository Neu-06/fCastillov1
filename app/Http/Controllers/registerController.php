<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Illuminate\Http\Request;
use App\Models\tUsuarios;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
        ]);

        tUsuarios::create([
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Usuario registrado correctamente');
    }
}
