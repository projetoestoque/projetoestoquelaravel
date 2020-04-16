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

Route::get('/', ['as' => 'main', 'uses' => function() {
	return view('welcome');
}]);

Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin/home', 'HomeController@adminHome')->name('admin.home');

   Route::get('/admin/marca', ['as'=> 'admin.marca', 'uses'=>'CadastroController@marca']);
   Route::get('/admin/tipo', ['as'=> 'admin.tipo', 'uses'=>'CadastroController@tipo']);
   Route::get('/admin/medida', ['as'=> 'admin.medida', 'uses'=>'CadastroController@medida']);

   Route::post('/admin/marca/cadastrar', ['as'=> 'admin.marca.cadastrar', 'uses'=>'CadastroController@cadastrarMarca']);
   Route::post('/admin/tipo/cadastrar', ['as'=> 'admin.tipo.cadastrar', 'uses'=>'CadastroController@cadastrarTipo']);
   Route::post('/admin/medida/cadastrar', ['as'=> 'admin.medida.cadastrar', 'uses'=>'CadastroController@cadastrarMedida']);
});


Route::get('/produto', ['as'=> 'produto', 'uses'=>'CadastroController@produto']);
Route::get('/doador', ['as'=> 'doador', 'uses'=>'CadastroController@doador']);

Route::post('/produto/cadastrar', ['as'=> 'produto.cadastrar', 'uses'=>'CadastroController@cadastrarProduto']);
Route::post('/doador/cadastrar', ['as'=> 'doador.cadastrar', 'uses'=>'CadastroController@cadastrarDoador']);

]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
