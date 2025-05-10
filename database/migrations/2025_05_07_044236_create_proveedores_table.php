<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id('id_proveedor'); // auto-incremental
            $table->string('nombreC_proveedor', 100); 
            $table->string('correo_proveedor', 100)->unique(); 
            $table->string('telefono_proveedor', 20)->nullable(); 
            $table->string('direccion_proveedor', 255)->nullable(); 
            $table->timestamps(); ///data de creacion y actualizacion
            $table->softDeletes(); // campo para eliminar logico
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
