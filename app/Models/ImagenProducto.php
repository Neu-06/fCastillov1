<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importamos la clase base Model de Laravel para trabajar con Eloquent
use Illuminate\Database\Eloquent\Model;
// Declaramos la clase ImagenProducto que representa la tabla 'imagen_producto' en la base de datos
class ImagenProducto extends Model
{// Usamos el trait HasFactory para poder usar fábricas de datos (útil para testing y seeding)
    use HasFactory;
    // Indicamos el nombre exacto de la tabla que representa este modelo
    protected $table = 'imagen_producto';
    // Indicamos el nombre de la clave primaria de la tabla
    protected $primaryKey = 'id_imagen';
    // Especificamos que la clave primaria se incrementa automáticamente (AUTO_INCREMENT)
    public $incrementing = true;
    // Definimos el tipo de la clave primaria como entero
    protected $keyType = 'int';
    // Desactivamos los timestamps automáticos (created_at y updated_at) porque la tabla no los tiene
    public $timestamps = false;
// Declaramos los campos que se pueden asignar de forma masiva (por ejemplo, con create())
    protected $fillable = [
        'ruta_imagen', // Aquí se guarda la ruta del archivo de imagen (por ejemplo: 'storage/imagenes/producto1.jpg')
        'public_id',
        'id_dproducto',// Esta es la clave foránea que conecta la imagen con un producto específico
         
    ];

    // Cada imagen pertenece a un producto_detalle
    public function productoDetalle()
    {
        return $this->belongsTo(DetalleProducto::class, 'id_dproducto', 'id_dproducto');
    }
}
