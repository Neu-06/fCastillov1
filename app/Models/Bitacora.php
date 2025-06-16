<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';
    protected $primaryKey = 'id_bitacora';

    public $timestamps = false; 

    protected $fillable = [
        'accion',
        'descripcion',
        'nombre_usuario',
        'ip_origen',
        'fecha_hora',
        'id_usuario'
    ];

    // Opcional: relación con usuarios
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
