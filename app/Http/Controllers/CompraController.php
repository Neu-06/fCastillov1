<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class CompraController extends Controller
{
    //
    public function index(Request $request)
    {
        $this->authorize('viewAny', Compra::class);

        $proveedorId = $request->input('proveedor_id');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $Proveedores = Proveedor::all();

        $compras = Compra::when($proveedorId, function ($query) use ($proveedorId) {
            return $query->where('id_proveedor', $proveedorId);
        })
            ->when($fechaInicio, function ($query) use ($fechaInicio) {
                return $query->whereDate('created_at', '>=', $fechaInicio);
            })
            ->when($fechaFin, function ($query) use ($fechaFin) {
                return $query->whereDate('created_at', '<=', $fechaFin);
            })
            ->paginate(10);

        return view('pages.gestion.compras.index', [
            'compras' => $compras,
            'Proveedores' => $Proveedores
        ]);
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $maxCompra = Compra::max('id_compra');  // asumiendo que 'codigo_compra' es un campo numérico
        $numeroCompra = $maxCompra ? $maxCompra + 1 : 1;
        return view('pages.gestion.compras.create', [
            'productos' => $productos,      // colección o array
            'numeroCompra' => $numeroCompra,
            'proveedores' => $proveedores,  // colección o array
        ]);
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|numeric|min:0.01',
            'productos.*.precio' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:0'
        ]);
        //dd($request->productos);
        try {
            DB::beginTransaction();

            // Guardar la compra
            $compra = new Compra();
            $compra->id_proveedor = $request->id_proveedor;
            $compra->total_compra = $request->total;
            $compra->save();

            // Guardar los productos en compra_detalle
            foreach ($request->productos as $producto) {
                $detalle = new DetalleCompra();
                $detalle->id_compra = $compra->id_compra;
                $detalle->id_producto = $producto['id_producto'];
                $detalle->cantidad = $producto['cantidad'];
                $detalle->precio = $producto['precio'];
                $detalle->subtotal = $producto['cantidad'] * $producto['precio'];
                $detalle->save();

                // Actualizar precios en detalle_productos
                $ProductoActualizar = Producto::findOrFail($producto['id_producto']);
                $nuevoPrecioCompra = $producto['precio'];
                $ProductoActualizar->stock = $ProductoActualizar->stock + $producto['cantidad'];
                // ✅ Actualizar precio_compra (último precio pagado)
                $ProductoActualizar->precio_compra = $nuevoPrecioCompra;

                // ✅ Calcular costo_promedio
                if ($ProductoActualizar->costo_promedio == 0) {
                    // Primera vez: el costo promedio es simplemente el nuevo precio
                    $ProductoActualizar->costo_promedio = $nuevoPrecioCompra;
                } else {
                    // Si ya existe un costo_promedio, se hace un promedio simple
                    $ProductoActualizar->costo_promedio = ($ProductoActualizar->costo_promedio + $nuevoPrecioCompra) / 2;
                }

                // ✅ Actualizar precio_venta (por ejemplo, 30% más que el costo promedio)
                //$ProductoActualizar->precio_venta = $ProductoActualizar->costo_promedio * 1.3;
                $ProductoActualizar->save();
            }

            DB::commit();

            BitacoraController::registrar(
                'CREAR',
                 'Se registró una compra con ID: ' . $compra->id_compra . ' del proveedor: ' . $compra->proveedor->nombreC_proveedor
             );

            return redirect()->route('compra.index')->with('success', 'Compra registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar la compra: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $compras = collect([
            Compra::with(['proveedor', 'detalles.producto'])->findOrFail($id)
        ]);
            
        return view('pages.gestion.compras.show', compact('compras'));
    }
    public function generarReporte(Request $request)
    {
        $compras = Compra::with(['proveedor', 'detalles.producto'])
            ->when($request->proveedor_id, fn($q) => $q->where('id_proveedor', $request->proveedor_id))
            ->when($request->fecha_inicio, fn($q) => $q->whereDate('created_at', '>=', $request->fecha_inicio))
            ->when($request->fecha_fin, fn($q) => $q->whereDate('created_at', '<=', $request->fecha_fin))
            ->get();

        $pdf = PDF::loadView('pages.gestion.reportes.compras', compact('compras'));

        return $pdf->download('reporte_compras.pdf');
    }

public function generarReporteWord(Request $request)
{
    $compras = Compra::with(['proveedor', 'detalles.producto'])
        ->when($request->proveedor_id, fn($q) => $q->where('id_proveedor', $request->proveedor_id))
        ->when($request->fecha_inicio, fn($q) => $q->whereDate('created_at', '>=', $request->fecha_inicio))
        ->when($request->fecha_fin, fn($q) => $q->whereDate('created_at', '<=', $request->fecha_fin))
        ->get();

    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
    $section->addText('Reporte de Compras', ['bold' => true, 'size' => 16]);
    $section->addText('');

    foreach ($compras as $compra) {
        $section->addText("Compra ID: {$compra->id_compra}", ['bold' => true]);
        $section->addText("Proveedor: {$compra->proveedor->nombreC_proveedor}");
        $section->addText("Total: {$compra->total_compra}");
        $section->addText("Fecha: {$compra->created_at}");
        $section->addText("Detalles:");

        // Crear tabla para los detalles de la compra
        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 50
        ]);
        // Encabezados de la tabla
        $table->addRow();
        $table->addCell(3000)->addText('Producto');
        $table->addCell(1500)->addText('Cantidad');
        $table->addCell(1500)->addText('Precio');
        $table->addCell(1500)->addText('Subtotal');

        // Filas de detalles
        foreach ($compra->detalles as $detalle) {
            $table->addRow();
            $table->addCell(3000)->addText($detalle->producto->nombre_producto);
            $table->addCell(1500)->addText($detalle->cantidad);
            $table->addCell(1500)->addText($detalle->precio);
            $table->addCell(1500)->addText($detalle->subtotal);
        }
        $section->addText(""); // Espacio entre compras
    }

    $fileName = 'reporte_compras.docx';
    $tempFile = tempnam(sys_get_temp_dir(), $fileName);
    $phpWord->save($tempFile, 'Word2007');

    return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
}
}
