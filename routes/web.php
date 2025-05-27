<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProductoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web para la aplicación. Estas rutas están
| cargadas por el RouteServiceProvider y todas están asignadas al grupo
| "web".
|
*/

// ==================== Rutas de Inicio ====================
Route::get('/', [HomeController::class, 'home'])->name('index'); // Vista principal

// ==================== Rutas de Logout (fuera del middleware) ====================
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');
Route::post('/cliente/logout', [ClienteController::class, 'logout'])->name('cliente.logout');


// ==================== Rutas de Autenticación ====================
Route::get('/login', [AccessController::class, 'showLogin'])->name('login');
Route::post('/login', [AccessController::class, 'login'])->name('login.post');
Route::get('/registro', [ClienteController::class, 'publicRegister'])->name('cliente.registro');
Route::post('/registro', [ClienteController::class, 'store'])->name('cliente.public.store');


//// rutas protegidas para administradores
Route::middleware(['auth:web'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'homeAdmin'])->name('admin.home');

    // ==================== Rutas de Usuarios ===================r
    Route::prefix('admin/usuario')->name('usuario.')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('index'); // Listar usuarios
        Route::get('/registro', [UsuarioController::class, 'create'])->name('create'); //formulario para registrar usuario
        Route::post('/registro', [UsuarioController::class, 'store'])->name('store'); //guardar usuario
        Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('edit'); //formulario para editar usuario
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('update'); //actualizar usuario
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('destroy'); //eliminar usuario

        Route::get('/eliminados', [UsuarioController::class, 'eliminados'])->name('eliminados');
        Route::put('/{id}/restaurar', [UsuarioController::class, 'restore'])->name('restore');

        //Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');
    });

    // ==================== Rutas de Roles ===================C
    Route::prefix('admin/rol')->name('rol.')->group(function () {
        Route::get('/', [RolController::class, 'index'])->name('index'); // Listar roles
        Route::get('/create', [RolController::class, 'create'])->name('create');
        Route::post('/create', [RolController::class, 'store'])->name('store');
        Route::delete('/{id}', [RolController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/permisos', [RolController::class, 'verPermisos'])->name('permisos');
        Route::get('/{id}/edit', [RolController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RolController::class, 'update'])->name('update');
    });



    // ==================== Rutas de Clientes ====================

    Route::prefix('admin/cliente')->name('cliente.')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('index'); // Listar clientes activos
        Route::get('/registro', [ClienteController::class, 'create'])->name('create'); // Formulario para registrar cliente
        Route::post('/registro', [ClienteController::class, 'store'])->name('store'); // Guardar cliente
        Route::get('/{id}/edit', [ClienteController::class, 'edit'])->name('edit'); // Formulario para editar cliente
        Route::put('/{id}', [ClienteController::class, 'update'])->name('update'); // Actualizar cliente
        Route::delete('/{id}', [ClienteController::class, 'destroy'])->name('destroy'); // Eliminar cliente (soft delete)

        Route::get('/eliminados', [ClienteController::class, 'eliminados'])->name('eliminados'); // Listar eliminados
        Route::put('/{id}/restaurar', [ClienteController::class, 'restore'])->name('restore'); // Restaurar cliente

        //Route::post('/logout', [ClienteController::class, 'logout'])->name('logout'); // cerrar seccion Para clientes
    });

    // ==================== Rutas de Proveedores ====================
    Route::prefix('admin/proveedor')->name('proveedor.')->group(function () {
        Route::get('/', [ProveedorController::class, 'index'])->name('index'); // Listar proveedores
        Route::get('/registro', [ProveedorController::class, 'create'])->name('create'); // Formulario para registrar proveedor
        Route::post('/registro', [ProveedorController::class, 'store'])->name('store'); // Guardar proveedor
        Route::get('/{id}/edit', [ProveedorController::class, 'edit'])->name('edit'); // Formulario para editar proveedor
        Route::put('/{id}', [ProveedorController::class, 'update'])->name('update'); // Actualizar proveedor
        Route::delete('/{id}', [ProveedorController::class, 'destroy'])->name('destroy'); // Eliminar proveedor

        // Opcionales para SoftDeletes
        Route::get('/eliminados', [ProveedorController::class, 'eliminados'])->name('eliminados'); // Listar eliminados
        Route::put('/{id}/restaurar', [ProveedorController::class, 'restore'])->name('restore'); // Restaurar proveedor
    });

    // ==================== Rutas de Permisos ====================
    Route::prefix('admin/permiso')->name('permiso.')->group(function () {
        Route::get('/', [PermisoController::class, 'index'])->name('index'); // Listar permisos
        Route::get('/create', [PermisoController::class, 'create'])->name('create'); // Formulario para registrar permiso
        Route::post('/create', [PermisoController::class, 'store'])->name('store'); // Guardar permiso
        Route::delete('/{id}', [PermisoController::class, 'destroy'])->name('destroy'); // Eliminar permiso
    });

    // ==================== Rutas de Productos ====================
    Route::prefix('admin/producto')->name('producto.')->group(function () {
        Route::get('/', [ProductoController::class, 'index'])->name('index'); // Listar productos
        Route::get('/create', [ProductoController::class, 'create'])->name('create'); // Formulario para registrar producto
        Route::post('/create', [ProductoController::class, 'store'])->name('store'); // Guardar producto
        Route::get('/{id}/edit', [ProductoController::class, 'edit'])->name('edit'); // Formulario para editar producto
        Route::put('/{id}', [ProductoController::class, 'update'])->name('update'); // Actualizar producto
        Route::delete('/{id}', [ProductoController::class, 'destroy'])->name('destroy'); // Eliminar producto
        // Rutas adicionales
        Route::get('/eliminados', [ProductoController::class, 'eliminados'])->name('eliminados'); // Mostrar productos eliminados
        Route::put('/{id}/restaurar', [ProductoController::class, 'restore'])->name('restore');    // Restaurar producto eliminado
    });

    // ==================== Rutas de Categorías ====================
    Route::prefix('admin/categoria')->name('categoria.')->group(function () {
        Route::get('/', [CategoriaController::class, 'index'])->name('index'); // Listar categorías
        Route::get('/create', [CategoriaController::class, 'create'])->name('create'); // Formulario para registrar categoría
        Route::post('/create', [CategoriaController::class, 'store'])->name('store'); // Guardar categoría
        Route::delete('/{id}', [CategoriaController::class, 'destroy'])->name('destroy'); // Eliminar categoría
    });
     // ==================== Rutas de Marcas ====================
    Route::prefix('admin/marca')->name('marca.')->group(function () {
        Route::get('/', [MarcaController::class, 'index'])->name('index'); // Listar marca
        Route::get('/create', [MarcaController::class, 'create'])->name('create'); // Formulario para registrar marca
        Route::post('/create', [MarcaController::class, 'store'])->name('store'); // Guardar marca
        Route::delete('/{id}', [MarcaController::class, 'destroy'])->name('destroy'); // Eliminar marca
    });
});

/// rutas protegidas para clientes
Route::middleware(['auth:cliente'])->group(function () {});
