<?php
//para crear un controlador se usa el comando
//php artisan make:controller nombreController

//el namespace es solo la ruta del controlador
namespace App\Http\Controllers;
use  App\Models\Categoria;
//use Illuminate\Http\Request;

class HomeController extends Controller
{ //se usa invoke para administrar una sola ruta
    public function home()
    {
     //   return view('pages.principal.index');
        $categorias = \App\Models\Categoria::all();
    return view('pages.principal.index', compact('categorias'));
         //return view('pages.principal.index', compact('categorias'));
        /*$categorias = Categoria::all();
        return view('index', compact('categorias'));*/

    }
// carrusel de imagenes
    public function index()
{
    $imagenes = [
        'imagenes/carusel1.png',
        // Puedes agregar más si las tienes:
        'imagenes/carusel2.png',
        // 'imagenes/carusel3.png',
    ];

    return view('home', compact('imagenes'));
}

    public function homeAdmin()
    {
         return view('pages.admin.homeAdmin');
    }
}
