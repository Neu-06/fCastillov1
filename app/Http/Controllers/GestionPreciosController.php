<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class GestionPreciosController extends Controller
{
    // Mostrar la vista principal con todos los productos y sus precios
   public function index()
{
    $productos = Producto::select('id_producto', 'codigo_producto', 'nombre_producto', 'stock', 'precio_venta', 'precio_compra')
    ->orderBy('nombre_producto', 'asc')
    ->get();


    return view('pages.gestion.gestion-precios.index', compact('productos'));
}


    // Mostrar el formulario de edición de precios
 public function edit($id)
{
    $producto = Producto::findOrFail($id);
    return view('pages.gestion.gestion-precios.edit', compact('producto'));
}



    // Actualizar los precios en la base de datos

public function update(Request $request, $id_producto)
{
    // Validar el porcentaje de ganancia
$request->validate([
    'ganancia' => 'required|numeric|min:0',
], [
    'ganancia.required' => 'Debe completar el campo de porcentaje de ganancia.',
    'ganancia.numeric' => 'El valor ingresado debe ser numérico.',
    'ganancia.min' => 'El porcentaje de ganancia no puede ser negativo.',
]);

    // Buscar el producto
    $producto = Producto::findOrFail($id_producto);

    // Calcular el nuevo precio de venta
    $ganancia = $request->ganancia; // porcentaje
    $precio_compra = $producto->precio_compra;
    $nuevo_precio_venta = $precio_compra + ($precio_compra * ($ganancia / 100));

    // Actualizar el precio
    $producto->precio_venta = $nuevo_precio_venta;

    // Guardar los cambios
    $producto->save();

    // Redirigir con mensaje
    return redirect()->route('gestionprecios.index')
        ->with('success', 'Precio de venta actualizado correctamente.');
}

    
}
