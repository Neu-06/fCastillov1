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
        Schema::create('detalle_productos', function (Blueprint $table) {
            $table->id('id_dproducto');
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('costo_promedio', 10, 2);
            $table->decimal('precio_compra', 10, 2);
            $table->string('descripcion')->nullable(); // 👈 Aquí se añade

            //llave foranea, BORRAR MARCA Y PONERLO A PRODUCTO. 
            $table->foreignId('id_producto')
                ->constrained('productos', 'id_producto')
                ->onDelete('cascade');
            $table->foreignId('id_marca')
                ->constrained('marcas', 'id_marca')
                ->nullable()
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_productos');
    }
};
