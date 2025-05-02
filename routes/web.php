<?php

use Illuminate\Support\Facades\Route;
//para usar un controlador se copia el namespace
//use App\Http\Controllers;
use App\Http\Controllers\homeController;

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
