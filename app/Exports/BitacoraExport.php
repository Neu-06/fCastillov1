<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class BitacoraExport implements FromCollection, WithHeadings
{
    protected $bitacoras;

    public function __construct(Collection $bitacoras)
    {
        $this->bitacoras = $bitacoras;
    }

    public function collection()
    {
        return $this->bitacoras->map(function ($b) {
            return [
                $b->accion,
                $b->descripcion,
                $b->nombre_usuario,
                $b->ip_origen,
                $b->fecha_hora,
            ];
        });
    }

    public function headings(): array
    {
        return ['Acción', 'Descripción', 'Usuario', 'IP', 'Fecha y Hora'];
    }
}