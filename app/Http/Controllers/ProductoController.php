<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar productos activos
    public function index()
    {
        $productos = Producto::all();
        return view('pages.gestion.productos.index', [
            'productos' => $productos,
            'eliminados' => false
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        $categorias = Categoria::all();
        return view('pages.gestion.productos.create', compact('categorias'));
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'codigo_producto' => 'required|string|max:50|unique:productos,codigo_producto',
            'nombre_producto' => 'required|string|max:100',
            'descripcion_producto' => 'nullable|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
        ]);

        Producto::create([
            'codigo_producto' => $request->codigo_producto,
            'nombre_producto' => $request->nombre_producto,
            'descripcion_producto' => $request->descripcion_producto,
            'id_categoria' => $request->id_categoria,
        ]);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $categorias = Categoria::all();
        return view('pages.gestion.productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar producto
    public function update(Request $request, $id_producto)
    {
        $request->validate([
            'codigo_producto' => 'required|string|max:50|unique:productos,codigo_producto,' . $id_producto . ',id_producto',
            'nombre_producto' => 'required|string|max:100',
            'descripcion_producto' => 'nullable|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
        ]);

        $producto = Producto::findOrFail($id_producto);
        $producto->codigo_producto = $request->codigo_producto;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->descripcion_producto = $request->descripcion_producto;
        $producto->id_categoria = $request->id_categoria;
        $producto->save();

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto (soft delete)
    public function destroy($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}
