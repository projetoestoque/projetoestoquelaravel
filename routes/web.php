<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/produto', ['as'=> 'produto', 'uses'=>'CadastroController@produto']);
Route::get('/doador', ['as'=> 'doador', 'uses'=>'CadastroController@doador']);

Route::post('/produto/cadastrar', ['as'=> 'produto.cadastrar', 'uses'=>'CadastroController@cadastrarProduto']);
Route::post('/doador/cadastrar', ['as'=> 'doador.cadastrar', 'uses'=>'CadastroController@cadastrarDoador']);