<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Authenticatable
{
    protected $primaryKey = 'ci';
    public $incrementing = false;
    
    use HasFactory;
    protected $fillable=['ci','nombre','correo','contrasena','telefono','direccion','estado'];

}
