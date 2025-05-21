<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use HasFactory, SoftDeletes;

    // Definimos la tabla que se va a utilizar
    //en este caso la tabla se llama 'usuarios'
    //si no se define, por defecto Eloquent asume que la tabla es el plural del nombre del modelo
    protected $table = 'usuarios';

    // Definimos la clave primaria de la tabla que es auto-incremental,entero
    //si no se define, por defecto Eloquent asume que la clave primaria es 'id'
    protected $primaryKey = 'id_usuario';
    public $incrementing = true;
    protected $keyType = 'int';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_usuario',
        'correo_usuario',
        'password_usuario',
        'id_rol',
    ];

    //para asegurar que el campo deleted_at se trate como una fecha
    //este campo se el nuevo campo estado del modelo original, por recomendacion de laravel
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'password_usuario',
    ];

    //llave foranea rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function getAuthPassword()
    {
        return $this->password_usuario;
    }

    public function setPasswordUsuarioAttribute($value)
    {
        $this->attributes['password_usuario'] = bcrypt($value);  // Encripta la contraseña
    }

    public function getAuthIdentifierName()
    {
        return 'correo_usuario'; // Cambia esto si usas otro campo para la autenticación
    }
}
