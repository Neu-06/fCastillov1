<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

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
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_cliente', 'id_cliente');
    }
    public function getEmailForPasswordReset()
    {
        return $this->correo_cliente;
    }

    public function getEmailAttribute()
    {
        return $this->correo_cliente;
    }
}
