<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BajaProducto extends Model
{
    use SoftDeletes;

    protected $table = 'baja_productos';
    protected $primaryKey = 'id_baja';

    public $timestamps = true;

    protected $fillable = [
        'cantidad_baja',
        'motivo_baja',
        'id_usuario',
        'id_producto',
    ];

    // Relaciones (no se usarán en vista, pero son útiles internamente)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
