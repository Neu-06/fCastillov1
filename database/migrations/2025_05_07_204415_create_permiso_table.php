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
        Schema::create('Permiso', function (Blueprint $table) {
            $table->id('id_permiso'); // ← nombre de tu clave primaria
            $table->string('descripcion'); // ← campo obligatorio
            $table->timestamps(); // puedes quitar esto si no lo necesitas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso');
    }
};
