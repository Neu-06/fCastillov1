<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permiso;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// Importar los modelos
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\DetalleProducto;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\ImagenProducto;


// Importar las policies asociadas
use App\Policies\UsuarioPolicy;
use App\Policies\RolPolicy;
use App\Policies\PermisoPolicy;
use App\Policies\ClientePolicy;
use App\Policies\ProveedorPolicy;
use App\Policies\CategoriaPolicy;
use App\Policies\DetalleProductoPolicy;
use App\Policies\ImagenProductoPolicy;
use App\Policies\MarcaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeo de modelos a sus respectivas Policies.
     * Esto permite que Laravel sepa qué policy usar para cada modelo.
     *
     * Ejemplo: @can('viewAny', App\Models\Usuario::class)
     * Laravel sabrá que debe buscar en UsuarioPolicy::viewAny()
     */

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Usuario::class => \App\Policies\UsuarioPolicy::class,
        Rol::class => RolPolicy::class,
        Permiso::class => PermisoPolicy::class,
        Proveedor::class => ProveedorPolicy::class,
        Cliente::class => ClientePolicy::class,
        Categoria::class => CategoriaPolicy::class,
        Marca::class => MarcaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
