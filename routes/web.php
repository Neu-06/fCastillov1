<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AreaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí se registran las rutas web para la aplicación. Estas rutas están
| cargadas por el RouteServiceProvider y todas están asignadas al grupo "web".
*/

Route::get('/', [HomeController::class, 'home'])->name('index'); // Vista principal
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');
Route::get('/marca/{id}', [MarcaController::class, 'show'])->name('marca.show');
Route::get('/categoria/{id}', [CategoriaController::class, 'productosPorCategoria'])->name('categoria.productos');

// ==================== Rutas de Logout ====================
Route::post('/cliente/logout', [ClienteController::class, 'logout'])->name('cliente.logout');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

// ==================== Rutas de Autenticación ====================
Route::get('/login', [AccessController::class, 'showLogin'])->name('login');
Route::post('/login', [AccessController::class, 'login'])->name('login.post');
Route::get('/registro', [ClienteController::class, 'publicRegister'])->name('cliente.registro');
Route::post('/registro', [ClienteController::class, 'store'])->name('cliente.public.store');

// ==================== Rutas de Administración (Protegidas) ====================
Route::middleware(['auth:web', 'prevent-back-history'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'homeAdmin'])->name('admin.home');

    // ==================== Usuarios ====================
    Route::prefix('admin/usuario')->name('usuario.')->group(function () {
        Route::get('/bitacora', [UsuarioController::class, 'index2'])->name('bitacora.index');
        Route::resource('/', UsuarioController::class)->except(['show']);
    });

    // ==================== Roles ====================
    Route::prefix('admin/rol')->name('rol.')->group(function () {
        Route::resource('/', RolController::class)->except(['show']);
        Route::get('/{id}/permisos', [RolController::class, 'verPermisos'])->name('permisos');
        Route::get('/{id}/edit', [RolController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RolController::class, 'update'])->name('update');
    });

    // ==================== Clientes ====================
    Route::prefix('admin/cliente')->name('cliente.')->group(function () {
        Route::resource('/', ClienteController::class)->except(['show']);
        Route::get('/eliminados', [ClienteController::class, 'eliminados'])->name('eliminados');
        Route::put('/{id}/restaurar', [ClienteController::class, 'restore'])->name('restore');
    });

    // ==================== Proveedores ====================
    Route::prefix('admin/proveedor')->name('proveedor.')->group(function () {
        Route::resource('/', ProveedorController::class)->except(['show']);
        Route::get('/eliminados', [ProveedorController::class, 'eliminados'])->name('eliminados');
        Route::put('/{id}/restaurar', [ProveedorController::class, 'restore'])->name('restore');
    });

    // ==================== Permisos ====================
    Route::prefix('admin/permiso')->name('permiso.')->group(function () {
        Route::resource('/', PermisoController::class)->except(['show']);
    });

    // ==================== Productos ====================
    Route::prefix('admin/producto')->name('producto.')->group(function () {
        Route::resource('/', ProductoController::class)->except(['show']);
        Route::get('/eliminados', [ProductoController::class, 'eliminados'])->name('eliminados');
        Route::put('/{id}/restaurar', [ProductoController::class, 'restore'])->name('restore');
    });

    // ==================== Categorías ====================
    Route::prefix('admin/categoria')->name('categoria.')->group(function () {
        Route::resource('/', CategoriaController::class)->except(['show']);
    });

    // ==================== Marcas ====================
    Route::prefix('admin/marca')->name('marca.')->group(function () {
        Route::resource('/', MarcaController::class)->except(['show']);
    });

    // ==================== Áreas ====================
    Route::prefix('admin/area')->name('area.')->group(function () {
        Route::resource('/', AreaController::class)->except(['show']);
    });

    // ==================== Compras ====================
    Route::prefix('admin/compra')->name('compra.')->group(function () {
        Route::resource('/', CompraController::class)->except(['show']);
        Route::get('/compras/{id}', [CompraController::class, 'show'])->name('show');
    });

    // ==================== Ventas ====================
    Route::prefix('admin/venta')->name('venta.')->group(function () {
        Route::resource('/', VentaController::class)->except(['show']);
        Route::get('/compras/{id}', [VentaController::class, 'show'])->name('show');
    });

    // ==================== Bitácora ====================
    Route::prefix('admin/bitacora')->name('bitacora.')->group(function () {
       // Route::get('/', [BitacoraController::class, 'index'])->name('index');
    });
});

// ==================== Rutas protegidas para clientes (vacías por ahora) ====================
Route::middleware(['auth:cliente'])->group(function () {
    // Aquí puedes agregar rutas específicas para clientes autenticados
});