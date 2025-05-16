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
        Schema::create('permiso_rol', function (Blueprint $table) {

            $table->foreignId('id_permiso')
                ->constrained('permisos', 'id_permiso')
                ->onDelete('cascade');

            $table->foreignId('id_rol')
                ->constrained('rols', 'id_rol')
                ->onDelete('cascade');

            $table->unique(['id_permiso', 'id_rol']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_rol');
    }
};
