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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta');
            $table->decimal('total_venta', 10, 2);
            $table->timestamps();
            //llave foranea 
            $table->foreignId('id_cliente')
                ->constrained('clientes', 'id_cliente')
                ->onDelete('cascade');
            $table->foreignId('id_usuario')
                ->constrained('usuarios', 'id_usuario')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
