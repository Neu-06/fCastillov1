<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BitacoraController;    
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::orderBy('nombre_categoria', 'asc')->paginate(10);
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
        
        BitacoraController::registrar(
            'CREAR',
            'Se creó la categoría: ' . $request->nombre_categoria
        );

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

        BitacoraController::registrar(
            'ELIMINAR',
            'Se eliminó la categoría: ' . $categoria->nombre_categoria
        );
        return redirect()->route('categoria.index')->with('success', 'Categoría eliminada correctamente.');
    }
    public function productosPorCategoria($id)
    {
        $categoria = Categoria::with('productos.imagenes')->findOrFail($id);
        return view('pages.productos.index', compact('categoria'));
    }



    //  Mostrar una categoría específica con sus productos
    /*public function show($id)
    {
       $categoria = \App\Models\Categoria::findOrFail($id);
       $productos = $categoria->productos; 
      return view('pages.gestion.categorias.show', compact('categoria', 'productos'));
    }*/
    //-----------------------------------
}
