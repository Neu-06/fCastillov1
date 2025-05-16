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
            //llave foranea
            $table->foreignId('id_usuario')
                ->constrained('usuarios', 'id_usuario')
                ->onDelete('cascade');
            $table->foreignId('id_inventario')
                ->constrained('inventarios', 'id_inventario')
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
