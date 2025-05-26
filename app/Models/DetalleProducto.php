<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Modelo que representa la tabla 'detalle_productos' en la base de datos
class DetalleProducto extends Model
{
    use HasFactory;

    // Nombre de la tabla exacta en la base de datos
    protected $table = 'detalle_productos';

    // Nombre de la clave primaria de la tabla
    protected $primaryKey = 'id_dproducto';

    // Indicamos que la clave primaria es autoincrementable
    public $incrementing = true;

    // Especificamos el tipo de la clave primaria (entero)
    protected $keyType = 'int';

    // Desactivamos los timestamps automáticos (created_at, updated_at) porque no existen en la tabla
    public $timestamps = false;

    // Lista de campos que se pueden asignar masivamente (con create() o update())
    protected $fillable = [
        'precio_venta',       // Precio al que se vende el producto
        'costo_promedio',     // Costo promedio del producto
        'precio_compra',      // Precio al que fue comprado el producto
        'descripcion',
        'id_producto',        // Clave foránea a la tabla productos
        'id_marca',           // Clave foránea a la tabla marcas
    ];

    /**
     * Relación: un detalle de producto puede tener muchas imágenes.
     * Esto nos permite acceder a todas las imágenes asociadas con: $detalle->imagenes
     */
    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'id_dproducto', 'id_dproducto');
    }

    /**
     * Relación: este detalle de producto pertenece a un producto general.
     * Esto permite acceder al producto base con: $detalle->producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /**
     * Relación: este detalle de producto pertenece a una marca.
     * Se accede con: $detalle->marca
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }

    /**
     * Relación: este detalle de producto pertenece a una unidad de medida.
     * Se accede con: $detalle->medida
     */

}
