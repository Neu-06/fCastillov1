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
use App\Http\Controllers\BajaProductoController;
use App\Http\Controllers\GestionPreciosController;
use App\Http\Controllers\EstanteController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\PasswordResetController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí se registran las rutas web para la aplicación. Estas rutas están
| cargadas por el RouteServiceProvider y todas están asignadas al grupo "web".
*/

// ==================== Rutas de Inicio ====================

Route::get('/', [HomeController::class, 'home'])->name('index'); // Vista principal
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');
Route::get('/marca/{id}', [MarcaController::class, 'show'])->name('marca.show');
Route::get('/categoria/{id}', [CategoriaController::class, 'productosPorCategoria'])->name('categoria.productos');

// ==================== Rutas de Logout ====================
// ==================== Rutas de Logout (fuera del middleware) ====================
Route::post('/cliente/logout', [ClienteController::class, 'logout'])->name('cliente.logout');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

// ==================== Rutas de Autenticación ====================
Route::get('/login', [AccessController::class, 'showLogin'])->name('login');
Route::post('/login', [AccessController::class, 'login'])->name('login.post');
Route::get('/registro', [ClienteController::class, 'publicRegister'])->name('cliente.registro');
Route::post('/registro', [ClienteController::class, 'store'])->name('cliente.public.store');

// ==================== Rutas de Administración (Protegidas) ====================

//// rutas protegidas para administradores
Route::middleware(['auth:web', 'prevent-back-history'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'homeAdmin'])->name('admin.home');

    // ==================== Usuarios ====================
    Route::prefix('admin/usuario')->name('usuario.')->group(function () {
        Route::get('/bitacora', [UsuarioController::class, 'index2'])->name('bitacora.index');
        Route::resource('/', UsuarioController::class)->except(['show']);
        Route::get('/', [UsuarioController::class, 'index'])->name('index'); // Listar usuarios
        Route::get('/registro', [UsuarioController::class, 'create'])->name('create'); //formulario para registrar usuario
        Route::post('/registro', [UsuarioController::class, 'store'])->name('store'); //guardar usuario
        Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('edit'); //formulario para editar usuario
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('update'); //actualizar usuario
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('destroy'); //eliminar usuario

        Route::get('/eliminados', [UsuarioController::class, 'eliminados'])->name('eliminados');
        Route::put('/{id}/restaurar', [UsuarioController::class, 'restore'])->name('restore');
        Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');
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
        Route::get('/', [ClienteController::class, 'index'])->name('index');
        Route::get('/registro', [ClienteController::class, 'create'])->name('create');
        Route::post('/registro', [ClienteController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ClienteController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ClienteController::class, 'update'])->name('update');
        Route::delete('/{id}', [ClienteController::class, 'destroy'])->name('destroy');

        Route::get('/eliminados', [ClienteController::class, 'eliminados'])->name('eliminados'); // Listar eliminados
        Route::put('/{id}/restaurar', [ClienteController::class, 'restore'])->name('restore'); // Restaurar cliente
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

    // ==================== Categorías ====================
    Route::prefix('admin/categoria')->name('categoria.')->group(function () {
        Route::resource('/', CategoriaController::class)->except(['show']);
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

    // ==================== Marcas ====================
    Route::prefix('admin/marca')->name('marca.')->group(function () {
        Route::resource('/', MarcaController::class)->except(['show']);
    });

    // ==================== Áreas ====================
    Route::prefix('admin/area')->name('area.')->group(function () {
        Route::resource('/', AreaController::class)->except(['show']);
    });
    // ==================== Rutas de Marcas ====================
    Route::prefix('admin/area')->name('area.')->group(function () {
        Route::get('/', [AreaController::class, 'index'])->name('index'); // Listar marca
        Route::get('/create', [AreaController::class, 'create'])->name('create'); // Formulario para registrar marca
        Route::post('/create', [AreaController::class, 'store'])->name('store'); // Guardar marca
        Route::delete('/{id}', [AreaController::class, 'destroy'])->name('destroy'); // Eliminar marca
    });
    // ==================== Compras ====================
    // ==================== Rutas de Marcas ====================
    Route::prefix('admin/compra')->name('compra.')->group(function () {
        Route::resource('/', CompraController::class)->except(['show']);
        Route::get('/compras/{id}', [CompraController::class, 'show'])->name('show');
    });

    // ==================== Ventas ====================
    Route::prefix('admin/venta')->name('venta.')->group(function () {
        Route::resource('/', VentaController::class)->except(['show']);
        Route::get('/compras/{id}', [VentaController::class, 'show'])->name('show');
    });

    // ==================== Rutas de Baja de Productos ====================
    Route::prefix('admin/baja-producto')->name('bajaproducto.')->group(function () {
        Route::get('/', [BajaProductoController::class, 'index'])->name('index');
        Route::get('/create', [BajaProductoController::class, 'create'])->name('create'); // Formulario para registrar baja
        Route::post('/create', [BajaProductoController::class, 'store'])->name('store');   // guardar formulario
    });
    // ==================== Rutas de Gestionar Precios ====================
    Route::prefix('admin/gestionprecios')->name('gestionprecios.')->group(function () {
        Route::get('/', [GestionPreciosController::class, 'index'])->name('index'); // Listar productos con precios
        Route::get('/{id}/edit', [GestionPreciosController::class, 'edit'])->name('edit'); // Formulario para editar precio
        Route::put('/{id}', [GestionPreciosController::class, 'update'])->name('update'); // Actualizar precio
    });

    // ==================== Rutas de Bajas de Productos ====================
    Route::prefix('admin/bajaproducto')->name('bajaproducto.')->group(function () {
        Route::get('/', [BajaProductoController::class, 'index'])->name('index');
        Route::get('/create', [BajaProductoController::class, 'create'])->name('create');
        Route::post('/buscar', [BajaProductoController::class, 'buscarProducto'])->name('buscar');
        Route::post('/create', [BajaProductoController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BajaProductoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BajaProductoController::class, 'update'])->name('update');
        Route::get('/realizadas', [BajaProductoController::class, 'realizadas'])->name('realizadas');
    });

    // ==================== Rutas de Ventas ====================
    Route::prefix('admin/venta')->name('venta.')->group(function () {
        Route::get('/', [VentaController::class, 'index'])->name('index');
        Route::get('/create', [VentaController::class, 'create'])->name('create');
        Route::post('/create', [VentaController::class, 'store'])->name('store');
        Route::delete('/{id}', [VentaController::class, 'destroy'])->name('destroy');
        Route::get('/compras/{id}', [VentaController::class, 'show'])->name('show');
    });

    // ==================== Rutas de Bitacora ====================
    Route::prefix('admin/bitacora')->name('bitacora.')->group(function () {
        Route::get('/', [BitacoraController::class, 'index'])->name('index'); // Listar marca
    });
});

Route::middleware(['auth:cliente'])->group(function () {});

Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
