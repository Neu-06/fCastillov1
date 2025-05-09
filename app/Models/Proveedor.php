<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory,SoftDeletes;

    // Specify the table name
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    public $incrementing = true;

    protected $fillable = [
        'nombreC_proveedor',
        'correo_proveedor',
        'telefono_proveedor',
        'direccion_proveedor',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
