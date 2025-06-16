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
            Schema::create('bitacoras', function (Blueprint $table) {
                $table->id('id_bitacora');

                $table->string('accion', 100);
                $table->text('descripcion')->nullable();
                $table->string('nombre_usuario', 100)->nullable();
                $table->string('ip_origen', 45)->nullable();
                $table->string('fecha_hora', 100)->nullable();

                //  Llave foránea opcional
                $table->foreignId('id_usuario')
                    ->nullable()
                    ->constrained('usuarios', 'id_usuario')
                    ->onDelete('set null');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
