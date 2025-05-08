<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Authenticatable
{
    // Especificar la clave primaria
    protected $primaryKey = 'ci';
    public $incrementing = false; // porque no es autoincremental
    protected $keyType = 'string'; // o 'int' si tu CI es numérico
    
    use HasFactory;
    protected $fillable=['ci','nombre','correo','contrasena','telefono','direccion','estado'];

}
