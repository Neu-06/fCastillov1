<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
use App\Models\Marca;

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
