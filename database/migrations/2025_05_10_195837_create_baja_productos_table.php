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
        Schema::create('baja_productos', function (Blueprint $table) {
            $table->id('id_baja');
            $table->decimal('cantidad_baja', 10, 2);
            $table->string('motivo_baja', 255);
            $table->timestamps();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_inventario');
            //llave foranea
            $table->foreignId('id_usuario')
                ->references('id_usuario')->on('usuarios')
                ->onDelete('cascade');
            $table->foreignId('id_inventario')
                ->references('id_inventario')->on('inventarios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baja_productos');
    }
};
