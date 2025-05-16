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
        Schema::create('estantes', function (Blueprint $table) {
            $table->id('id_estante');
            $table->string('codigo_estante', 50)->unique();
            $table->string('nombre_estante', 50);
            $table->unsignedBigInteger('id_area')->nullable();
            //llave foranea
            $table->foreignId('id_area')
                ->references('id_area')->on('areas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estantes');
    }
};
