<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    use HasFactory;
     protected $table = 'estantes';

    // Nombre de la clave primaria si no es "id"
    protected $primaryKey = 'id_estante';

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
         'id_area',
        'nombre_estante'
    ];
        // Relación con el modelo Estante
    public function Producto()
    {
        return $this->hasMany(Producto::class, 'id_estante', 'id_estante');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
}
