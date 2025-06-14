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

    $productos = Producto::all()->map(function ($producto) {
    return [                      //segundo:nombre exacto en el modelo
        'id_producto' => $producto->id_producto,
    //primero:nombre con el que llamo en la vista
        'stock' => $producto->stock,
        'nombre_producto' => $producto->nombre_producto,
        'descripcion' => $producto->descripcion,
        'precio_promedio' => $producto->precio_promedio,
        'precio_venta' => $producto->precio_venta,
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
        'productos.*.id_producto' => 'required|exists:productos,id_producto',
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
            $detalle->id_producto = $producto['id_producto'];
            
            $detalle->cantidad = $producto['cantidad'];
            $detalle->precio = $producto['precio_venta'];
            //dd($request->all()); // 👈 Esto muestra todos los campos recibidos antes de guardar
           // dd($producto['cantidad'], $producto['precio'], $producto['cantidad'] * $producto['precio']);
            $detalle->subtotal = $producto['cantidad'] * $producto['precio_venta'];
           
            $detalle->save();
             //dd($request->all()); // 👈 Esto muestra todos los campos recibidos antes de guardar
            // Actualizar el stock en detalle_productos (restar lo vendido)
            $Producto = Producto::findOrFail($producto['id_producto']);

            if ($Producto->stock < $producto['cantidad']) {
                throw new \Exception('Stock insuficiente para el producto: ' . $Producto->id_producto);
            }

            $Producto->stock -= $producto['cantidad'];
            $Producto->save();
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
    public function show($id)
    {
    $ventas = collect([
        Venta::with(['cliente', 'detalle.producto'])->findOrFail($id)
    ]);

    return view('pages.gestion.ventas.show', compact('ventas'));
    }
}
