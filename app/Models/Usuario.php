<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    // Definimos la tabla que se va a utilizar
    //en este caso la tabla se llama 'usuarios'
    //si no se define, por defecto Eloquent asume que la tabla es el plural del nombre del modelo
    protected $table = 'usuarios';

    // Definimos la clave primaria de la tabla que es auto-incremental,entero
    //si no se define, por defecto Eloquent asume que la clave primaria es 'id'
    protected $primaryKey = 'id_usuario';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Atributos asignables en masa (formulario).
     */
    protected $fillable = [
        'nombre_usuario',
        'correo_usuario',
        'password_usuario',
        'id_rol',
    ];

    //para asegurar que el campo deleted_at se trate como una fecha
    //este campo se el nuevo campo estado del modelo original, por recomendacion de laravel
    //activa el comportamiento de eliminacion logica (soft delete)
    protected $casts = [

        'deleted_at' => 'datetime',
        // marca el campo deleted_at con la fecha en que se elimino
    ];

    /**
     * Oculta el campo de contraseña al serializar.
     */
    protected $hidden = [
        'password_usuario',
    ];

    //llave foranea rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    /**
     * Devuelve el campo de contraseña personalizado.
     */
    public function getAuthPassword()
    {
        return $this->password_usuario;
    }

    public function setPasswordUsuarioAttribute($value)
    {
        $this->attributes['password_usuario'] = bcrypt($value);  // Encripta la contraseña
    }

    /**
     * Define qué campo se usará para el login (correo personalizado).
     */
    public function getAuthIdentifierName()
    {
        return 'id_usuario'; // Cambia esto si usas otro campo para la autenticación
    }


    /**
     * Devuelve todos los permisos asociados al usuario a través de su rol.
     */
    public function permisos()
    {
        return $this->rol ? $this->rol->permisos : collect([]);
    }

    /**
     * Verifica si el usuario tiene un permiso específico.
     */
    public function tienePermiso($permiso)
    {
        return $this->permisos()->contains('nombre_permiso', $permiso);
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_usuario', 'id_usuario');
    }

    public function getEmailForPasswordReset()
    {
        return $this->correo_usuario;
    }

    public function getEmailAttribute()
    {
        return $this->correo_usuario;
    }
}
