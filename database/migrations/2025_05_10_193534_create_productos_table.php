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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo_producto', 50)->unique();
            $table->string('nombre_producto', 100);
            //$table->string('descripcion_producto', 255)->nullable();
            //llave foranea 
            $table->foreignId('id_categoria')
                ->constrained('categorias', 'id_categoria')
                ->nullable()
                ->onDelete('set null');
            $table->softDeletes();  // ✅ esto permite soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
