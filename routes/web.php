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

Route::get('/', ['as' => 'home', 'uses' => function() {
	return view('welcome');
}]);

Route::get('/admin/login', ['as'=> 'admin.login', 'uses'=>'AdminController@login']);
Route::post('/admin/login/entrar', ['as'=> 'admin.login.entrar', 'uses'=>'AdminController@postLogin']);
Route::get('/admin/login/sair', ['as'=> 'admin.login.sair', 'uses'=>'AdminController@sair']);

Route::get('/superv/login', ['as'=> 'superv.login', 'uses'=>'SupervController@login']);
Route::post('/superv/login/entrar', ['as'=> 'superv.login.entrar', 'uses'=>'SupervController@postLogin']);
Route::get('/superv/login/sair', ['as'=> 'superv.login.sair', 'uses'=>'SupervController@sair']);

Route::get('/produto', ['as'=> 'produto', 'uses'=>'CadastroController@produto']);
Route::get('/doador', ['as'=> 'doador', 'uses'=>'CadastroController@doador']);

Route::post('/produto/cadastrar', ['as'=> 'produto.cadastrar', 'uses'=>'CadastroController@cadastrarProduto']);
Route::post('/doador/cadastrar', ['as'=> 'doador.cadastrar', 'uses'=>'CadastroController@cadastrarDoador']);


	Route::get('/admin/marca', ['as'=> 'admin.marca', 'uses'=>'CadastroController@marca']);
	Route::get('/admin/tipo', ['as'=> 'admin.tipo', 'uses'=>'CadastroController@tipo']);
	Route::get('/admin/medida', ['as'=> 'admin.medida', 'uses'=>'CadastroController@medida']);

	Route::post('/admin/marca/cadastrar', ['as'=> 'admin.marca.cadastrar', 'uses'=>'CadastroController@marcaCadastrar']);
	Route::post('/admin/tipo/cadastrar', ['as'=> 'admin.tipo.cadastrar', 'uses'=>'CadastroController@tipoCadastrar']);
	Route::post('/admin/medida/cadastrar', ['as'=> 'admin.medida.cadastrar', 'uses'=>'CadastroController@produtoCadastrar']);




Route::get('/admin', ['as'=> 'admin', 'uses'=>'AdminController@logado']);
Route::get('/superv', ['as'=> 'superv', 'uses'=>'SupervController@logado']);
