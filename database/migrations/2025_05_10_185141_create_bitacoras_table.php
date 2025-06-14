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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id('id_bitacora'); // ID de la bitácora
            $table->unsignedBigInteger('id_usuario');
            $table->string('accion', 100); // Acción realizada (crear, actualizar, eliminar, etc.)
            $table->string('tabla_afectada', 100)->nullable(); // Nombre de la tabla afectada
            $table->text('descripcion')->nullable(); // Descripción de la acción
            $table->string('nombre_usuario', 100)->nullable(); // Nombre del usuario que realizó la acción
            $table->string('correo_usuario', 100)->nullable(); // Nombre de la tabla afectada
            $table->string('ip_origen', 45)->nullable(); // Dirección IP desde donde se realizó la acción
            $table->timestamps(); // Campos created_at y updated_at

            //llave foranea
            $table->foreign('id_usuario')
             ->references('id_usuario')
            ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
