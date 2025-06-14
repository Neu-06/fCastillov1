<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    
    // Nombre de la tabla (opcional si el nombre del modelo coincide con la tabla en plural)
    protected $table = 'compra_detalle';

    // Clave primaria personalizada
    protected $primaryKey = 'id_compraDetalle';

    // Los atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'precio',
        'cantidad',
        'subtotal',
        'id_compra',
        'id_producto',
    ];

    // Si la clave primaria no es un entero autoincremental, podrías necesitar esto:
    // public $incrementing = true;
    // protected $keyType = 'int';

    // Relaciones
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

     public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'id_producto', 'id_producto');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class,  'id_producto', 'id_producto');
    }
    
}
