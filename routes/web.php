<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\homeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\accessController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\gestionController;
use App\Http\Controllers\RegisterController;

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
Route::get('/', homeController::class)->name('home');

// ==================== Rutas de Autenticación ====================
Route::get('/login', [accessController::class, 'showLogin'])->name('login');
Route::post('/login', [accessController::class, 'login'])->name('login.post');
Route::get('/Register', [accessController::class, 'showRegister']);
Route::get('/regProv', [accessController::class, 'showRegProv']);
Route::post('/logout', function (Request $request) {
    Auth::logout(); // Cierra la sesión
    $request->session()->invalidate(); // Invalida la sesión
    $request->session()->regenerateToken(); // Regenera el token CSRF
    return redirect()->route('home'); // Redirige al home
})->name('logout');

// ==================== Rutas de Usuarios ====================
Route::get('/usuarioRegister', [UsuarioController::class, 'usuarioRegister'])->name('vista.usuarioRegister');
Route::post('/usuarios/store', [UsuarioController::class, 'agregarUsuarios'])->name('usuarios.store');
Route::get('/admin/usuarios/{ci}/editar', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('/admin/usuarios/{ci}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/admin/usuarios/{ci}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route::get('/administrador/usuarios', [UsuarioController::class, 'gestionarUsuario'])->name('administrador.gestionarUsuario');
Route::get('/home/vendedor', [UsuarioController::class, 'homeVendedor'])->name('vista.vendedor.home');
Route::get('/home/administrador', [UsuarioController::class, 'homeAdmin'])->name('vista.administrador.home');

// ==================== Rutas de Roles ====================
Route::get('/admin/roles', [RolController::class, 'index']);
Route::get('/admin/rolesCreate', [RolController::class, 'create'])->name('roles.create');
Route::post('/admin/rolStore', [RolController::class, 'store'])->name('roles.store');
Route::delete('/admin/roles/{id}', [RolController::class, 'destroy'])->name('roles.destroy');
Route::resource('roles', RolController::class);

// ==================== Rutas de Clientes ====================
// Ruta para mostrar el formulario de registro de clientes
Route::get('/cliente/register', [ClienteController::class, 'showRegister'])->name('cliente.register');
// Ruta para procesar el registro de clientes
Route::post('/cliente/register', [ClienteController::class, 'store'])->name('cliente.store');
Route::post('/clienteLogin', [ClienteController::class, 'login']);

// ==================== Rutas de Gestión ====================
Route::get('/gestion/usuarios', [gestionController::class, 'showUserG']);
