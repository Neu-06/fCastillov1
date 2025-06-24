<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

     protected $primaryKey = 'id_venta'; // Importante si no usas 'id' como nombre de clave primaria

    protected $fillable = [
        'total_venta',
        'id_cliente',
        'id_usuario',
    ];

    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
}

public function cliente()
{
    return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
}
    public function detalle()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id_venta');
    }
}
