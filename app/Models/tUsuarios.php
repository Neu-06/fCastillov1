<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tUsuarios extends Model
{
    protected $table = 'usuarios';         // Tu tabla
    protected $primaryKey = 'id_usuario';  // Tu PK
    public $timestamps = false;            // Porque tu tabla no tiene created_at, etc.

    protected $fillable = ['email', 'password_hash'];

    // Para encriptar al guardar
    public function setPasswordHashAttribute($value)
    {
        $this->attributes['password_hash'] = bcrypt($value);
    }
}
