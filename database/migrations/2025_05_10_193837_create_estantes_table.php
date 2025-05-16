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
            //llave foranea
            $table->foreignId('id_area')
                ->constrained('areas', 'id_area')
                ->nullable()
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
