<?php

use Illuminate\Support\Facades\Route;
//para usar un controlador se copia el namespace
//use App\Http\Controllers;
use App\Http\Controllers\homeController;
use App\Http\Controllers\accessController;
use App\Http\Controllers\RegisterController;
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
Route::get('/',homeController::class);


Route::get('/login',[accessController::class, 'showLogin']);
Route::get('/Register',[accessController::class, 'showRegister']);
Route::get('/regProv',[accessController::class, 'showRegProv']);



Route::post('/register', [registerController::class, 'store']);
