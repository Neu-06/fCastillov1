<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
        // Nombre de la tabla si no sigue la convención
    protected $table = 'marcas';

    // Nombre de la clave primaria si no es "id"
    protected $primaryKey = 'id_marca';

    // Si tu clave primaria NO es autoincremental tipo integer, agrega esto (opcional en tu caso)
    //Indica que la clave primaria se incrementa automáticamente (auto-increment).
    public $incrementing = true;

    // Si tu clave es bigint
    //Informa a Laravel que el tipo de dato de la clave primaria es entero (int).
    protected $keyType = 'int';

    // Si tu tabla NO tiene columnas `created_at` y `updated_at`
    public $timestamps = false;

    // Campos que se pueden llenar con asignación masiva (fillable)
    //Define qué campos pueden ser llenados masivamente usando funciones como create() o update() con arrays
    protected $fillable = [
        'nombre_marca'
    ];
        // Relación con DetalleProducto
    public function Productos()
    {
        return $this->hasMany(Producto::class, 'id_marca', 'id_marca');
    }
}
