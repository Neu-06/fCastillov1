<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;


    protected $table = 'marcas';
    protected $primaryKey = 'id_marca';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre_marca'
   ];

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_marca');
    }
}
