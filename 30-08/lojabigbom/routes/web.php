<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::group(['middleware'  =>  ['auth']], function(){

    Route::resource('/clientes',
    App\Http\Controllers\ClienteController::class);

    Route::resource('/vendedores',
    App\Http\Controllers\VendedoresController::class);

    Route::resource('/produtos',
    App\Http\Controllers\ProdutosController::class);

    Route::resource('/users',
    App\Http\Controllers\ProdutosController::class);

    Route::resource('/roles',
    App\Http\Controllers\ProdutosController::class);
});
