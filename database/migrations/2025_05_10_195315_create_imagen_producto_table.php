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
        Schema::create('imagen_producto', function (Blueprint $table) {
            $table->id('id_imagen');
            $table->string('ruta_imagen', 255);
            $table->string('public_id')->nullable(); // ✅ Nuevo campo
            $table->foreignId('id_dproducto')
                ->constrained('detalle_productos', 'id_dproducto')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagen_producto');
    }
};
