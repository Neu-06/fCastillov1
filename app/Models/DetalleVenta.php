<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

     // Nombre de la tabla
    protected $table = 'venta_detalle';

    // Clave primaria personalizada
    protected $primaryKey = 'id_ventaDetalle';

    // Si la clave primaria no es autoincremental ni tipo entero, agrega esto:
    // public $incrementing = false;
    // protected $keyType = 'string';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'precio',
        'cantidad',
        'subtotal',
        'id_venta',
        'id_producto',
    ];

    // Relaciones

    // Una venta detalle pertenece a una venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }

    // Una venta detalle pertenece a un detalle de producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
