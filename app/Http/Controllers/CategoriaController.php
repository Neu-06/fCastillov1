<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::all();
        return view('pages.gestion.categorias.index', compact('categorias'));
    }

    // Mostrar formulario para crear una nueva categoría
    public function create()
    {
        return view('pages.gestion.categorias.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categorias,nombre_categoria',
        ]);

        Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
        ]);

        return redirect()->route('categoria.index')->with('success', 'Categoría creada correctamente.');
    }

    // Eliminar una categoría
    public function destroy($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria);

        // Verificar si tiene productos relacionados
        if ($categoria->productos()->count() > 0) {
            return redirect()->route('categoria.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('categoria.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
