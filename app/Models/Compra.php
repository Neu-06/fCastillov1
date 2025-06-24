<?php

namespace App\Models;
use App\Models\DetalleCompra;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
     // Nombre de la tabla (opcional si sigue la convención Laravel)
    protected $table = 'compras';

    // Nombre de la clave primaria personalizada
    protected $primaryKey = 'id_compra';

    // Si la clave primaria no es autoincremental o no es tipo int, especificarlo
    public $incrementing = true;
    protected $keyType = 'int';

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'total_compra',
        'id_proveedor',
    ];

    // Relación: una compra pertenece a un proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
    public function detalles()
{
    return $this->hasMany(DetalleCompra::class, 'id_compra', 'id_compra');
}
}
