<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//todo Esta linea lo que hace es generar todas las rutas en las listas. Te genera las 7 funciones que hay en el controlador que esta en la ruta app/Controllers/ProductController.php de una vez.

Route::resource('products' , ProductController::class); //? Genera la lista de las funciones que hay en el controlador ProductController 

