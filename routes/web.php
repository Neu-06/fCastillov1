<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PermisoController;
use App\Models\Cliente;
use App\Models\Usuario;

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
Route::get('/admin/home', [HomeController::class, 'homeAdmin'])->name('admin.home');


// ==================== Rutas de Autenticación ====================
Route::get('/login', [AccessController::class, 'showLogin'])->name('login');
Route::post('/login', [AccessController::class, 'login'])->name('login.post');


Route::post('/logout', function (Request $request) {
    Auth::logout(); // Cierra la sesión
    $request->session()->invalidate(); // Invalida la sesión
    $request->session()->regenerateToken(); // Regenera el token CSRF
    return redirect()->route('home'); // Redirige al home
})->name('logout');

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
});

// ==================== Rutas de Roles ===================C
Route::prefix('admin/rol')->name('rol.')->group(function () {
    Route::get('/', [RolController::class, 'index'])->name('index'); // Listar roles
    Route::get('/create', [RolController::class, 'create'])->name('create');
    Route::post('/create', [RolController::class, 'store'])->name('store');
    Route::delete('/{id}', [RolController::class, 'destroy'])->name('destroy');
});



// ==================== Rutas de Clientes ====================

// Formulario de registro público
Route::get('/Register', [ClienteController::class, 'publicRegister'])->name('cliente.register'); 


Route::prefix('admin/cliente')->name('cliente.')->group(function () {
    Route::get('/', [ClienteController::class, 'index'])->name('index'); // Listar clientes activos
    Route::get('/registro', [ClienteController::class, 'create'])->name('create'); // Formulario para registrar cliente
    Route::post('/registro', [ClienteController::class, 'store'])->name('store'); // Guardar cliente
    Route::get('/{id}/edit', [ClienteController::class, 'edit'])->name('edit'); // Formulario para editar cliente
    Route::put('/{id}', [ClienteController::class, 'update'])->name('update'); // Actualizar cliente
    Route::delete('/{id}', [ClienteController::class, 'destroy'])->name('destroy'); // Eliminar cliente (soft delete)
    
    Route::get('/eliminados', [ClienteController::class, 'eliminados'])->name('eliminados'); // Listar eliminados
    Route::put('/{id}/restaurar', [ClienteController::class, 'restore'])->name('restore'); // Restaurar cliente
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
