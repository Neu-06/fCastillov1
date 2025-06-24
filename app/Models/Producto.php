<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Permite usar "factories" para crear instancias del modelo en pruebas.
use Illuminate\Database\Eloquent\Model; // Importa la clase base Eloquent de Laravel.
use Illuminate\Database\Eloquent\SoftDeletes; // Importa la funcionalidad de "borrado lógico".

class Producto extends Model
{
    use HasFactory; // Habilita la creación de productos de prueba con "factories".
    use SoftDeletes; // Habilita el borrado lógico. Usará la columna `deleted_at`.

    // Nombre de la tabla en la base de datos
    protected $table = 'productos';

    // Clave primaria personalizada (por defecto sería "id")
    protected $primaryKey = 'id_producto';

    // Especifica que la clave primaria es autoincremental
    public $incrementing = true;

    // Indica que no se usan las columnas automáticas created_at y updated_at
    public $timestamps = false;

    // Define el tipo de dato de la clave primaria
    protected $keyType = 'int';

    // Lista de atributos que se pueden asignar masivamente
    protected $fillable = [
        'codigo_producto',     // Código único del producto (ej. P001)
        'nombre_producto',     // Nombre del producto (ej. Martillo)
        'descripcion',         // Descripción del producto
        'precio_venta',        // Precio de venta al cliente
        'costo_promedio',      // Promedio de costo entre compras
        'precio_compra',       // Precio de compra desde proveedor
        'stock',               // Cantidad en inventario
        'id_categoria',        // ID de la categoría a la que pertenece
        'id_marca',            // ID de la marca
        'id_estante',            // ID de la estante
    ];

    // ======================= RELACIONES ==========================

    // Relación: un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    // Relación: un producto tiene muchas imágenes asociadas
    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'id_producto', 'id_producto');
    }

    // Relación: un producto puede estar en varios detalles de compra
    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'id_producto', 'id_producto');
    }

    // Relación: un producto puede estar en varios detalles de venta
    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto', 'id_producto');
    }
    public function bajas()
    {
        return $this->hasMany(BajaProducto::class, 'id_producto', 'id_producto');
    }
    // Relación: un producto pertenece a una marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }
    
    // Relación: un producto pertenece a un área (antes estaba mal con "Marca")
    public function estante()
    {
        return $this->belongsTo(Estante::class, 'id_estante');
    }

}

