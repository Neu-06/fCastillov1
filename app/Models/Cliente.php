<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id_cliente';
    public $incrementing = true;

    protected $fillable = [
        'nombre_cliente',
        'apellido_cliente',
        'correo_cliente',
        'password_cliente',
        'telefono_cliente',
        'direccion_cliente',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password_cliente',
    ];

    public function setPasswordClienteAttribute($value)
    {
        $this->attributes['password_cliente'] = bcrypt($value);
    }

    public function getAuthPassword()
    {
        return $this->password_cliente;
    }

    public function getAuthIdentifierName()
    {
        return 'correo_cliente';
    }
}
