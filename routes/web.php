<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//para usar un controlador se copia el namespace
//use App\Http\Controllers;
use App\Http\Controllers\homeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\accessController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//se elimina el namespace de la clase en vez de la funcion
Route::get('/',homeController::class)->name('home');;


Route::get('/login',[accessController::class, 'showLogin'])->name('login');
Route::get('/Register',[accessController::class, 'showRegister']);
Route::get('/regProv',[accessController::class, 'showRegProv']);
Route::get('/admin/roles',[RolController::class, 'index'])->name('roles.home');
Route::get('/admin/rolesCreate',[RolController::class, 'create'])->name('roles.create');
Route::get('/home/vendedor',[UsuarioController::class, 'homeVendedor'])->name('vista.vendedor.home');
Route::get('/home/administrador',[UsuarioController::class, 'homeAdmin'])->name('vista.administrador.home');
Route::get('/administrador/clientes', [ClienteController::class, 'gestionarCliente'])->name('administrador.gestionarCliente');
Route::get('/administrador/usuarios', [UsuarioController::class, 'gestionarUsuario'])->name('administrador.gestionarUsuario');
Route::get('/usuarioRegister',[UsuarioController::class, 'usuarioRegister'])->name('vista.usuarioRegister');
Route::get('/clienteRegister',[ClienteController::class, 'clienteRegister'])->name('vista.clienteRegister');

Route::get('/admin/usuarios/{ci}/editar', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::get('/admin/clientes/{ci}/editar', [ClienteController::class, 'edit'])->name('cliente.edit');

Route::put('/admin/usuarios/{ci}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::put('/admin/clientes/{ci}', [ClienteController::class, 'update'])->name('cliente.update');


Route::post('/admin/rolStore',[RolController::class, 'store'])->name('roles.store');
Route::post('/usuarios/store', [UsuarioController::class, 'agregarUsuarios'])->name('usuarios.store');
Route::post('/clientes/store', [ClienteController::class, 'agregarClientes'])->name('clientes.stores');
Route::post('/cliente/register', [ClienteController::class, 'store'])->name('cliente.store');
Route::post('/clienteLogin', [ClienteController::class, 'login']);




Route::post('/logout', [accessController::class, 'cerrarSesion'])->name('logout');
Route::delete('/admin/usuarios/{ci}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route::delete('/admin/clientes/{ci}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
Route::delete('/admin/roles/{id}', [RolController::class, 'destroy'])->name('rol.destroy');
// Eliminar rol
Route::delete('/admin/roles/{id}', [RolController::class, 'destroy'])->name('roles.destroy');



//al realizar este comando, ya no va a ser necesario las dos rutas anteriores? 
Route::prefix('administrador')->group(function(){
    Route::resource('proveedor', ProveedorController::class);
});