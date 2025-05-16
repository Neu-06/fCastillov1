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

            //llave foranea
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->unsignedBigInteger('id_marca')->nullable();
            $table->unsignedBigInteger('id_medida')->nullable();

            $table->foreignId('id_producto')
                ->references('id_producto')->on('productos')
                ->onDelete('set null');
            $table->foreignId('id_marca')
                ->references('id_marca')->on('marcas')
                ->onDelete('set null');
            $table->foreignId('id_medida')
                ->references('id_medida')->on('medidas')
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
