<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    use HasFactory;

    // Especificar la clave primaria
    protected $primaryKey = 'ci';
    public $incrementing = false; // porque no es autoincremental
    protected $keyType = 'int'; // o 'int' si tu CI es numérico

    protected $fillable=['ci','nombre','correo','contrasena','estado','id_rol'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
    public function tienePermiso($descripcion)
    {
        return $this->rol && $this->rol->permisos->contains('descripcion', $descripcion);
    }

}
