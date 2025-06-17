<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\BajaProducto;

class BajaProductoController extends Controller
{


public function index()
{
    // Obtener todos los productos ordenados alfabéticamente
    $productos = Producto::orderBy('nombre_producto', 'asc')->get();

    // Enviar a la vista, y agregamos 'eliminados' en false
    return view('pages.gestion.baja-producto.index', [
        'productos' => $productos,
        'eliminados' => false
    ]);
}



   public function create()
{
    return view('pages.gestion.baja-producto.create'); // ESTA vista tiene que ser la que vos preparaste para registrar bajas
}


public function store(Request $request)
{
    // Validar campos
    $request->validate([
        'cantidad_baja' => 'required|integer|min:1',
        'motivo_baja' => 'required|string|max:100',
        'id_producto' => 'required|exists:productos,id_producto',
    ]);

    $producto = Producto::findOrFail($request->id_producto);

    // Verificar si hay suficiente stock
       if ($request->cantidad_baja > $producto->stock) {
        return redirect()->back()
            ->withInput()
            ->withErrors([
                'cantidad_baja' => 'La cantidad de baja no puede ser mayor al stock disponible.'
            ]);
    }

    // Registrar la baja
    BajaProducto::create([
        'cantidad_baja' => $request->cantidad_baja,
        'motivo_baja' => $request->motivo_baja,
        'id_usuario' => auth()->id(),
        'id_producto' => $producto->id_producto,
    ]);

    // Actualizar el stock
    $producto->stock -= $request->cantidad_baja;
    $producto->save();

    return redirect()->route('bajaproducto.index')->with('success', 'Baja registrada correctamente.');
}


   public function edit($id)
{
    $producto = Producto::findOrFail($id);
    return view('pages.gestion.baja-producto.edit', compact('producto'));
}



public function update(Request $request, $id)
{
    $request->validate([
        'cantidad' => 'required|integer|min:1',
        'motivo' => 'required|string|max:255',
    ]);

    $producto = Producto::findOrFail($id);

    if ($request->cantidad > $producto->stock) {
        return redirect()->back()->withErrors(['cantidad' => 'La cantidad supera el stock disponible.']);
    }

    // Descontar del stock
    $producto->stock -= $request->cantidad;
    $producto->save();

    // Registrar la baja
    BajaProducto::create([
        'producto_id' => $producto->id_producto,
        'cantidad' => $request->cantidad,
        'motivo' => $request->motivo,
    ]);

    return redirect()->route('bajaproducto.index')
        ->with('success', 'Baja registrada correctamente.');
}


public function Realizadas()
{
    $bajas = BajaProducto::with('producto')  // Asegúrate de tener esta relación en el modelo
        ->orderByDesc('created_at')
        ->get();

    return view('pages.gestion.baja-producto.index', [
        'bajas' => $bajas,
        'mostrarBajas' => true,
    ]);
}


public function buscarProducto(Request $request)
{
    $request->validate([
        'busqueda' => 'required|string'
    ]);

    $producto = Producto::where('codigo_producto', $request->busqueda)
        ->orWhere('nombre_producto', $request->busqueda)
        ->first();

    if (!$producto) {
        return redirect()->back()->withErrors(['busqueda' => 'Producto no encontrado.']);
    }

    return redirect()->route('bajaproducto.edit', ['id' => $producto->id_producto]);
}


}
