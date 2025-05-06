<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class gestionController extends Controller
{
    public function showUserG(){
        return view('pages.gestion.usuariosG');
    }

    public function showHomeG(){
        return view('pages.gestion.homeG');
    }
}
