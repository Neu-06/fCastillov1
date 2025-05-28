<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'int';

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'descripcion_producto',
        'id_categoria',
    ];

    // Relación con la categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
        // 🔗 Relación con detalle del producto (1 a 1)
    public function detalle()
    {
        return $this->hasOne(DetalleProducto::class, 'id_producto', 'id_producto');
    }
}
