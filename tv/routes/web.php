<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagenController;

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

////Route::get('/', function () {
   // return view('welcome');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

//});

// Route::get('/subir-imagen', function () {
//     return view('subir-imagen');
// });
Route::get('/subir-imagen', [ImagenController::class, 'index']);
Route::post('/guardar-imagen', [ImagenController::class, 'guardarImagen'])->name('guardar-imagen');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
