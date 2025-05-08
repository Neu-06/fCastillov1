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
        Schema::create('rol_permiso', function (Blueprint $table) {
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('id_permiso');

            // Claves foráneas
            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');
            $table->foreign('id_permiso')->references('id_permiso')->on('Permiso')->onDelete('cascade');

            // Clave primaria compuesta
            $table->primary(['rol_id', 'id_permiso']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_permiso');
    }
};
