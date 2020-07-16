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

Route::get('/teste', 'ProdutoController@pesquisarEntrada')->name('teste');

Route::get('/', ['as' => 'main', 'uses' => function() {
	return view('welcome');
}]);
Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin/home', 'HomeController@adminHome')->name('admin.home');
    Route::get('/admin/cadastros', 'CadastroController@Cadastros')->name('admin.cadastros');
    Route::get('/admin/MenuEstoque', 'CadastroController@CadastrosInsercoes')->name('admin.MenuEstoque');
    Route::get('/admin/MenuCadastros', 'CadastroController@menuCadastros')->name('admin.MenuCadastros');
    Route::get('/admin/MenuInsercoes', 'CadastroController@Insercoes')->name('admin.insercoes');
    Route::get('/admin/listarCadastros/{reference?}', 'CadastroController@listarCadastros')->name('admin.listarCadastros');
    Route::get('/admin/produto/editar/{id}', 'CadastroController@editarProduto')->name('admin.produto.editar');
    Route::put('/admin/produto/atualizar/{id}', 'CadastroController@salvarAlteracoes')->name('admin.produto.atualizar');
    Route::delete('/admin/produto/remover/{id}', 'CadastroController@deletarAlteracoes')->name('admin.produto.deletar');
    

   Route::get('/admin/marca', ['as'=> 'admin.marca', 'uses'=>'CadastroController@marca']);
   Route::get('/admin/tipo', ['as'=> 'admin.tipo', 'uses'=>'CadastroController@tipo']);
   Route::get('/admin/medida', ['as'=> 'admin.medida', 'uses'=>'CadastroController@medida']);

   Route::get('/admin/marca/atualizar', 'CadastroController@marcaAtualizar')->name('marca.atualizar');
   Route::get('/admin/medida/atualizar', 'CadastroController@medidaAtualizar')->name('medida.atualizar');
   Route::get('/admin/tipo/atualizar', 'CadastroController@tipoAtualizar')->name('tipo.atualizar');
   Route::get('/admin/estoque/atualizar', 'CadastroController@estoqueAtualizar')->name('estoque.atualizar');
   
   
   Route::post('/marca/atualizar', 'MarcaController@atualizarMarca')->name('admin.marca.atualizar');
   Route::post('/medida/atualizar', 'MedidaController@atualizarMedida')->name('admin.medida.atualizar');
   Route::get('/tipo/atualizar', 'TipoController@atualizarTipo')->name('admin.tipo.atualizar');
   Route::post('/estoque/atualizar', 'EstoqueController@atualizarEstoque')->name('admin.estoque.atualizar');
   Route::post('/doador/atualizar', 'DoadorController@atualizarDoador')->name('admin.doador.atualizar');

   Route::get('admin/marca/deletar', 'MarcaController@deletarMarca')->name('admin.marca.deletar');
   Route::get('admin/medida/deletar', 'MedidaController@deletarMedida')->name('admin.medida.deletar');
   Route::get('admin/tipo/deletar', 'TipoController@deletarTipo')->name('admin.tipo.deletar');
   Route::get('admin/estoque/deletar', 'EstoqueController@deletarEstoque')->name('admin.estoque.deletar');
   Route::get('admin/doador/deletar', 'DoadorController@deletarDoador')->name('admin.doador.deletar');


   Route::post('/admin/marca/cadastrar', ['as'=> 'admin.marca.cadastrar', 'uses'=>'CadastroController@cadastrarMarca']);
   Route::post('/admin/tipo/cadastrar', ['as'=> 'admin.tipo.cadastrar', 'uses'=>'CadastroController@cadastrarTipo']);
   Route::post('/admin/medida/cadastrar', ['as'=> 'admin.medida.cadastrar', 'uses'=>'CadastroController@cadastrarMedida']);
   Route::post('/admin/estoque/cadastrar', ['as'=> 'admin.estoque.cadastrar', 'uses'=>'CadastroController@cadastrarEstoque']);
  
   Route::post('/admin/entrada/produto/atualizar', ['as'=> 'admin.entrada.produto.atualizar', 'uses'=>'ProdutoController@entradaAtualizar']);
   Route::post('/admin/produto/atualizar', ['as'=> 'admin.produto.atualizar', 'uses'=>'ProdutoController@produtoAtualizar']);

  
   Route::post('/admin/cadastros', ['as'=> 'admin.refeicao.cadastrar', 'uses'=>'CadastroController@cadastrarRefeicao']);

   Route::get('/admin/buscar/entrada/', 'EstoqueController@pesquisarEntrada')->name('admin.buscar.entrada');
   Route::get('/admin/buscar/cadastros/', 'CadastroController@pesquisarCadastros')->name('admin.buscar.cadastros');
   Route::get('/admin/buscar/codigo_barra/', 'CadastroController@pesquisarCodigoBarra')->name('admin.buscar.codigo_barra');
});


Route::get('/produto', ['as'=> 'produto', 'uses'=>'CadastroController@produto']);
Route::get('/doador', ['as'=> 'doador', 'uses'=>'CadastroController@doador']);
Route::get('/relatorio', ['as'=> 'relatorio', 'uses'=>'RelatorioController@index']);
Route::get('/refeicao', ['as'=> 'refeicao', 'uses'=>'CadastroController@refeicao']);
Route::get('/entradaProduto', ['as'=> 'entradaProduto', 'uses'=>'CadastroController@entradaProduto']);
Route::post('/entradaProduto', ['as'=> 'entradaProdutoPost', 'uses'=>'CadastroController@entradaProdutoPost']);

Route::post('/doador/fisico', ['as'=> 'doador.fisico', 'uses'=>'CadastroController@doadorFisico']);
Route::post('/doador/juridico', ['as'=> 'doador.juridico', 'uses'=>'CadastroController@doadorJuridico']);
Route::post('/produto/cadastrar', ['as'=> 'produto.cadastrar', 'uses'=>'CadastroController@cadastrarProduto']);
Route::post('/refeicao/cadastros', ['as'=> 'refeicao.cadastrar', 'uses'=>'CadastroController@cadastrarRefeicao']);
Route::get('/produto/listar', ['as'=> 'produtos.listar', 'uses'=>'ProdutoController@listar_produtos']);

Route::get('/produto/deletar', 'ProdutoController@deletarProduto')->name('produto.deletar');
Route::get('/produto/entrada/deletar', 'ProdutoController@deletarEntrada')->name('entrada.deletar');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/estoque', 'HomeController@estoqueMenu')->name('estoqueMenu');
Route::get('/estoque/entrada', 'HomeController@estoqueEntradas')->name('estoqueEntradas');
Route::get('/home/cadastros', 'CadastroController@CadastrosSupervisor')->name('superv.cadastros');

Route::get('/saida', ['as'=> 'saida', 'uses'=>'SaidaController@index']);


