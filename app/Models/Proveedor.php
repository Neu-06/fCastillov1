<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    //nombre real de la tabla en la base de datos
    protected $table = 'proveedor';
    //nombre de la clave primaria personalizada
    protected $primaryKey = 'id_proveedor';
    //laravel no usara created_at y updatet_at 
    // public $timestamps = false; 
  

    //campos permitidos para llenado masivo (ej. desde form)
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
    ];
}
