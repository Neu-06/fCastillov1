<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'Permiso';
    protected $primaryKey = 'id_permiso';
    // public $timestamps = false;

    protected $fillable = ['descripcion'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_permiso', 'id_permiso', 'rol_id');
    }
}
