<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Categoria;
use App\Models\Area;
use App\Models\Marca;
use App\Exports\ReporteInventarioExport;
use Maatwebsite\Excel\Facades\Excel;


class ReporteInventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'bajas', 'estante.area']);

        // Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('id_categoria', $request->categoria_id);
        }
        // Filtro por Area
        if ($request->filled('area_id')) {
            $query->whereHas('estante.area', function ($q) use ($request) {
                $q->where('id_area', $request->area_id);
            });
        }
        // Filtro por marca
        if ($request->filled('marca_id')) {
            $query->where('id_marca', $request->marca_id);
        }

        $productos = $query->get()->map(function ($producto) {
            $entradas = $producto->detallesCompra->sum('cantidad');
            $salidas = $producto->detallesVenta->sum('cantidad');
            $bajas = $producto->bajas->sum('cantidad_baja');
            //$existencia = $entradas - $salidas - $bajas;

            return [
                'codigo' => $producto->codigo_producto,
                'nombre' => $producto->nombre_producto,
                'descripcion' => $producto->descripcion,
                'categoria' => $producto->categoria->nombre_categoria ?? 'Sin categoría',
                'entradas' => $entradas,
                'salidas' => $salidas,
                'bajas' => $bajas,
                'stock' => $producto->stock,
                'ubicacion_existencias' => $producto->estante?->area?->nombre_area . ', ' . $producto->estante?->nombre_estante,
                'existencia' => $entradas - $salidas - $bajas, 
            ];
        });
        // Filtro dinámico por stock bajo
        if ($request->filled('stock_min')) {
            $stockMin = (int) $request->stock_min;
            $productos = $productos->filter(fn($p) => $p['existencia'] <= $stockMin);
        }

        $categorias = Categoria::all();
        $areas = Area::all();
        $marcas = Marca::all();

        // Si se solicita como PDF
        if ($request->has('pdf')) {
            $pdf = Pdf::loadView('pages.gestion.reportes.inventario_pdf', compact('productos', 'categorias', 'areas', 'marcas'));
            return $pdf->stream('reporte_inventario.pdf');
        }
        // Si se solicita como EXCEL
        if ($request->has('excel')) {
            return Excel::download(new ReporteInventarioExport($productos), 'reporte_inventario.xlsx');
        }


        // Vista normal
        return view('pages.gestion.reportes.inventario', compact('productos', 'categorias', 'areas', 'marcas'));
    }
}
