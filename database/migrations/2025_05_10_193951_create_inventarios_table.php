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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->decimal('cantidad', 10, 2);
            $table->unsignedBigInteger('id_estante');
            $table->unsignedBigInteger('id_dproducto');
            //llave foranea 
            $table->foreignId('id_estante')
                ->references('id_estante')->on('estantes')
                ->onDelete('cascade');
            $table->foreignId('id_dproducto')
                ->references('id_dproducto')->on('detalle_productos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
