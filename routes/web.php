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

Route::get('ajaxRequest', 'CadastroController@ajax')->name('teste');

Route::get('/', ['as' => 'main', 'uses' => function() {
	return view('welcome');
}]);

Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin/home', 'HomeController@adminHome')->name('admin.home');
    Route::get('/admin/cadastros', 'CadastroController@Cadastros')->name('admin.cadastros');
    Route::get('/admin/MenuCadastros', 'CadastroController@CadastrosInsercoes')->name('admin.MenuCadastros');
    Route::get('/admin/MenuInsercoes', 'CadastroController@Insercoes')->name('admin.insercoes');

   Route::get('/admin/marca', ['as'=> 'admin.marca', 'uses'=>'CadastroController@marca']);
   Route::get('/admin/tipo', ['as'=> 'admin.tipo', 'uses'=>'CadastroController@tipo']);
   Route::get('/admin/medida', ['as'=> 'admin.medida', 'uses'=>'CadastroController@medida']);

   Route::get('/admin/marca/atualizar', 'CadastroController@marcaAtualizar')->name('marca.atualizar');
   Route::get('/admin/medida/atualizar', 'CadastroController@medidaAtualizar')->name('medida.atualizar');
   Route::get('/admin/tipo/atualizar', 'CadastroController@tipoAtualizar')->name('tipo.atualizar');
   Route::get('/admin/estoque/atualizar', 'CadastroController@estoqueAtualizar')->name('estoque.atualizar');

   Route::post('/admin/marca/cadastrar', ['as'=> 'admin.marca.cadastrar', 'uses'=>'CadastroController@cadastrarMarca']);
   Route::post('/admin/tipo/cadastrar', ['as'=> 'admin.tipo.cadastrar', 'uses'=>'CadastroController@cadastrarTipo']);
   Route::post('/admin/medida/cadastrar', ['as'=> 'admin.medida.cadastrar', 'uses'=>'CadastroController@cadastrarMedida']);
   Route::post('/admin/estoque/cadastrar', ['as'=> 'admin.estoque.cadastrar', 'uses'=>'CadastroController@cadastrarEstoque']);
  
   Route::post('/admin/cadastros', ['as'=> 'admin.refeicao.cadastrar', 'uses'=>'CadastroController@cadastrarRefeicao']);
});


Route::get('/produto', ['as'=> 'produto', 'uses'=>'CadastroController@produto']);
Route::get('/doador', ['as'=> 'doador', 'uses'=>'CadastroController@doador']);
Route::get('/refeicao', ['as'=> 'refeicao', 'uses'=>'CadastroController@refeicao']);
Route::get('/entradaProduto', ['as'=> 'entradaProduto', 'uses'=>'CadastroController@entradaProduto']);
Route::post('/entradaProduto', ['as'=> 'entradaProdutoPost', 'uses'=>'CadastroController@entradaProdutoPost']);

Route::post('/doador/fisico', ['as'=> 'doador.fisico', 'uses'=>'CadastroController@doadorFisico']);
Route::post('/doador/juridico', ['as'=> 'doador.juridico', 'uses'=>'CadastroController@doadorJuridico']);
Route::post('/produto/cadastrar', ['as'=> 'produto.cadastrar', 'uses'=>'CadastroController@cadastrarProduto']);
Route::post('/refeicao/cadastros', ['as'=> 'refeicao.cadastrar', 'uses'=>'CadastroController@cadastrarRefeicao']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/cadastros', 'CadastroController@CadastrosSupervisor')->name('superv.cadastros');

