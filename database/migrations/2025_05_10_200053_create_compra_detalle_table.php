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
        Schema::create('compra_detalle', function (Blueprint $table) {
            $table->id('id_compraDetalle');
            $table->unsignedBigInteger('id_compra');
            $table->unsignedBigInteger('id_dproducto');
            $table->decimal('precio', 10, 2);
            $table->decimal('cantidad', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            //llave foranea 
            $table->foreignId('id_compra')
                ->references('id_compra')->on('compras')
                ->onDelete('cascade');
            $table->foreignId('id_detalle_producto')
                ->references('id_dproducto')->on('detalle_productos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_detalle');
    }
};
