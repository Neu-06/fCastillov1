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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo_producto', 50)->unique();
            $table->string('nombre_producto', 100);
<<<<<<< HEAD
            $table->string('descripcion')->nullable(); 
=======
            $table->string('descripcion')->nullable();
>>>>>>> b9d46be73149d0defb18fbf5f71b8f97895af70e
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('costo_promedio', 10, 2);
            $table->decimal('precio_compra', 10, 2);
            $table->integer('stock')->default(0);
<<<<<<< HEAD

            // llaves foráneas
            $table->foreignId('id_area')
                ->nullable()
                ->constrained('areas', 'id_area')
                ->onDelete('set null');

            $table->foreignId('id_categoria')
                ->nullable()
                ->constrained('categorias', 'id_categoria')
                ->onDelete('set null');

            $table->foreignId('id_marca')
                ->nullable()
                ->constrained('marcas', 'id_marca')
                ->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
=======
            //llave foranea 
            $table->foreignId('id_categoria')
                ->nullable()
                ->constrained('categorias', 'id_categoria')

                ->onDelete('set null');
            $table->softDeletes();
            $table->foreignId('id_marca')
                ->nullable()
                ->constrained('marcas', 'id_marca')

                ->onDelete('set null');
>>>>>>> b9d46be73149d0defb18fbf5f71b8f97895af70e
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
