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
        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->unsignedBigInteger('id_permiso');
            $table->unsignedBigInteger('id_rol');

            // Claves foráneas
            $table->foreign('id_permiso')->references('id_permiso')->on('permisos')->onDelete('cascade');
            $table->foreign('id_rol')->references('id_rol')->on('rols')->onDelete('cascade');

            // Índice único para evitar duplicados
            $table->unique(['id_permiso', 'id_rol']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_rol');
    }
};
