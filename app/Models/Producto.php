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
        'descripcion',
        'precio_venta',       // Precio al que se vende el producto
        'costo_promedio',     // Costo promedio del producto
        'precio_compra',      // Precio al que fue comprado el producto
         'stock',
        'id_categoria',
        'id_marca', 
    ];
    // Relación con la categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'id_producto', 'id_producto');
    }

    /**
     * Relación: este detalle de producto pertenece a un producto general.
     * Esto permite acceder al producto base con: $detalle->producto
     */
    
     public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'id_producto', 'id_producto');
    }
    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto', 'id_producto');
    }
    /**
     * Relación: este detalle de producto pertenece a una marca.
     * Se accede con: $detalle->marca
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }
}
