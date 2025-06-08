<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\DetalleProducto;
use Illuminate\Support\Facades\DB;
use App\Models\DetalleVenta;
class VentaController extends Controller
{
    //

        public function index()
    {
        $this->authorize('viewAny', Venta::class);
        $ventas = Venta::all();
        return view('pages.gestion.ventas.index', [
            'ventas' => $ventas
        ]);
    }

    // Mostrar formulario para crear una nueva categoría
    public function create()
{
    $clientes = Cliente::all();

    $productos = DetalleProducto::with('producto')->get()->map(function ($detalle) {
        return [
            'id_dproducto' => $detalle->id_dproducto,
            'id_producto' => $detalle->producto->id_producto,
            'stock' => $detalle->stock,
            'nombre_producto' => $detalle->producto->nombre_producto,
            'descripcion' => $detalle->producto->descripcion,
            'precio_venta' => $detalle->precio_venta,
        ];
    });

    $maxVenta = Venta::max('id_venta');
    $numeroVenta = $maxVenta ? $maxVenta + 1 : 1;

    return view('pages.gestion.ventas.create', [
        'clientes' => $clientes,
        'numeroVenta' => $numeroVenta,
        'productos' => $productos,
    ]);
}

    public function store(Request $request)
{
    $request->validate([
        'id_cliente' => 'required|exists:clientes,id_cliente',
        'productos' => 'required|array|min:1',
        'productos.*.id_producto' => 'required|exists:detalle_productos,id_dproducto',
        'productos.*.cantidad' => 'required|numeric|min:0.01',
        'productos.*.precio_venta' => 'required|numeric|min:0.01',
        'total' => 'required|numeric|min:0'
    ]);
    
    try {
        DB::beginTransaction();
         
       // Guardar la venta
$venta = new Venta();
$venta->id_cliente = $request->id_cliente;

$venta->id_usuario = auth()->id(); // ✅ Usar el usuario autenticado si tienes auth

$venta->total_venta = $request->total;

$venta->save();
        
        // Guardar los productos en detalle_venta
        foreach ($request->productos as $producto) {
            $detalle = new DetalleVenta();
            $detalle->id_venta = $venta->id_venta;
            $detalle->id_dproducto = $producto['id_producto'];
            
            $detalle->cantidad = $producto['cantidad'];
            $detalle->precio = $producto['precio_venta'];
            //dd($request->all()); // 👈 Esto muestra todos los campos recibidos antes de guardar
           // dd($producto['cantidad'], $producto['precio'], $producto['cantidad'] * $producto['precio']);
            $detalle->subtotal = $producto['cantidad'] * $producto['precio_venta'];
           
            $detalle->save();
             //dd($request->all()); // 👈 Esto muestra todos los campos recibidos antes de guardar
            // Actualizar el stock en detalle_productos (restar lo vendido)
            $detalleProducto = DetalleProducto::findOrFail($producto['id_producto']);

            if ($detalleProducto->stock < $producto['cantidad']) {
                throw new \Exception('Stock insuficiente para el producto: ' . $detalleProducto->id_dproducto);
            }

            $detalleProducto->stock -= $producto['cantidad'];
            $detalleProducto->save();
        }

        DB::commit();

        return redirect()->route('venta.index')->with('success', 'Venta registrada correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
    }
}


    // Eliminar una categoría
    public function destroy($id_categoria)
    {
       
    }
}
