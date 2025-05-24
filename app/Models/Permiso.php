<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_permiso';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'int';

    protected $fillable = ['nombre_permiso'];
//Aquí se define qué campos son seguros para la asignación masiva.

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'permiso_rol', 'id_permiso', 'id_rol');
    }
}
