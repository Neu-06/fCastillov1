<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteInventarioExport implements FromCollection, WithHeadings
{
    protected $productos;

    public function __construct(Collection $productos)
    {
        $this->productos = $productos;
    }

    public function collection()
    {
        return $this->productos->map(function ($p) {
            return [
                $p['codigo'],
                $p['nombre'],
                $p['descripcion'],
                $p['categoria'],
                $p['entradas'],
                $p['salidas'],
                $p['bajas'],
                $p['stock'],
                $p['ubicacion_existencias'],
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Código', 'Nombre', 'Descripción', 'Categoría', 'Entradas', 'Salidas', 'Bajas', 'Stock', 'Ubicación',
        ];
    }
}
