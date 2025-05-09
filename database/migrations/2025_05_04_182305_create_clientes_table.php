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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente'); // auto-incremental
            $table->string('nombre_cliente', 100); 
            $table->string('apellido_cliente', 100);
            $table->string('correo_cliente', 100)->unique(); 
            $table->string('password_cliente', 255); 
            $table->string('telefono_cliente', 20)->nullable(); 
            $table->string('direccion_cliente', 255)->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
