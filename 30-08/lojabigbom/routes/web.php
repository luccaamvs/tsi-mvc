<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\ProdutosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/avisos', function(){
  //Comandos Exception
  $av = ['avisos' => [0 => [ 'data' => '06/09/202',
                             'aviso' => 'Estudar PHP',
                             'exibir' => true],

                       1 => ['data' => '09/09/202',
                             'aviso' => ' Sexta-feira',
                             'exibir' => false],

                       2 => ['data' => '18/09/202',
                             'aviso' => ' Meu Aniversario',
                             'exibir' => true]]];


  return view('avisos', $av);
});

Route::resource('/clientes', App\Http\Controllers\ClienteController::class);
Route::resource('/vendedores', App\Http\Controllers\VendedoresController::class);
Route::resource('/produtos', App\Http\Controllers\ProdutosController::class);
