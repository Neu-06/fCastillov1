<?php

namespace App\Providers;


use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\ImagenProducto;
use App\Models\Marca;
use App\Models\Permiso;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Rol;
use App\Models\User;
use App\Models\Usuario;
use App\Models\Venta;
use App\Models\Bitacora;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aquí puedes registrar servicios personalizados si los necesitas.
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        View::composer('components.header.navs.navMenu', function ($view) {
            $view->with([
                'categorias' => Categoria::with('productos')->get(),
                'marcas' => Marca::all(),
            ]);
        });
    }
}





