<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    
    protected $primaryKey = 'id_rol';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nombre_rol'];
}


