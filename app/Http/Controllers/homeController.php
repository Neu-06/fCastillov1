<?php
//para crear un controlador se usa el comando
//php artisan make:controller nombreController

//el namespace es solo la ruta del controlador
namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class HomeController extends Controller
{ //se usa invoke para administrar una sola ruta
    public function home()
    {
        return view('pages.principal.index');
    }

    public function homeAdmin()
    {
         return view('pages.admin.homeAdmin');
    }
}
