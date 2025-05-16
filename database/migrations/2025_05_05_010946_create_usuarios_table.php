<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // se ejecuata cuando se ejecuta el comando php artisan migrate
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre_usuario', 100);
            $table->string('correo_usuario', 100)->unique();
            $table->string('password_usuario', 255);
            $table->foreignId('id_rol')
                ->nullable()
                ->constrained('rols', 'id_rol')
                ->onDelete('set null');
            $table->timestamps();
            $table->softDeletes(); // Agrega la columna deleted_at para eliminación lógica(estado)

        });
    }

    // se ejecuta cuando se ejecuta el comando php artisan migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
