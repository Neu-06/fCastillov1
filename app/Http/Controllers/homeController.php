<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Página principal para usuarios
    public function home()
    {
         //  return view('pages.principal.index');
          $categorias = Categoria::with(['productos.imagenes'])->withCount('productos')->get();
        return view('pages.principal.index', compact('categorias'));
        
    }

    // Carrusel de imágenes 
    public function index()
    {
        $imagenes = [
            'imagenes/carusel1.png',
            'imagenes/carusel2.png',
        ];

        return view('home', compact('imagenes'));
    }

    // Página principal para el administrador
    public function homeAdmin()
    {
        return view('pages.admin.homeAdmin');
    }
}
