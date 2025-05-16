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
            //llave foranea 
            $table->foreignId('id_estante')
                ->constrained('estantes', 'id_estante')
                ->onDelete('cascade');
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
        Schema::dropIfExists('inventarios');
    }
};
