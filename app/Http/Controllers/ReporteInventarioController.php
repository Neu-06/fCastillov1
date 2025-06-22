<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteInventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'detallesCompra', 'detallesVenta', 'bajas']);

        // Filtro por fecha
        if ($request->filled('fecha_desde') && $request->filled('fecha_hasta')) {
            $query->whereBetween('created_at', [$request->fecha_desde, $request->fecha_hasta]);
        }

        $productos = $query->get()->map(function ($producto) {
            $entradas = $producto->detallesCompra->sum('cantidad');
            $salidas = $producto->detallesVenta->sum('cantidad');
            $bajas = $producto->bajas->sum('cantidad_baja');
            //$existencia = $entradas - $salidas - $bajas;

            return [
                'codigo' => $producto->codigo_producto,
                'nombre' => $producto->nombre_producto,
                'descripcion'=> $producto->descripcion,
                'categoria' => $producto->categoria->nombre_categoria ?? 'Sin categoría',
                'entradas' => $entradas,
                'salidas' => $salidas,
                'bajas' => $bajas,
                'stock' => $producto->stock,
                'ubicacion_existencias' => $producto->estante?->area?->nombre_area . ', ' . $producto->estante?->nombre_estante,
            ];
        });

        // Si se solicita como PDF
        if ($request->has('pdf')) {
            $pdf = Pdf::loadView('pages.gestion.reportes.inventario_pdf', compact('productos'));
            return $pdf->stream('reporte_inventario.pdf');
        }

        // Vista normal
        return view('pages.gestion.reportes.inventario', compact('productos'));
    }
}
