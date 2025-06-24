<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;


    protected $table = 'rols';
    protected $primaryKey = 'id_rol';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'int';

    protected $fillable = ['nombre_rol'];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'permiso_rol', 'id_rol', 'id_permiso');
    }


    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_rol');
    }
}
