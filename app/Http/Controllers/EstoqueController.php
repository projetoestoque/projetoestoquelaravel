<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque_disponivel;
use App\Produto;
use App\Produto_em_estoque;
use App\Marca;
use DB;

class EstoqueController extends Controller
{
  public function listar_estoques()
    {
        $estoques_cadastrados=DB::table('estoques')->orderBy('estoque')->get();

      return view('listagem', compact('estoques_cadastrados'));
    }

  public function atualizarEstoque(Request $req)
  {
    $estoque_id = $req->get('id');
    $estoque = Estoque_disponivel::findOrFail($estoque_id);
    $estoque->estoque = $req->get('estoque');
    $estoque->save();
    return redirect()->route('admin.cadastros')->with('update', 'Estoque atualizado com sucesso!');
  }

  public function deletarEstoque()
  {
      $estoque_id = $_GET['id'];
      $estoque = Estoque_disponivel::find($estoque_id);
      $estoque->delete();
      return redirect()->back()->with('status', 'Estoque deletado com sucesso!');
  }

  public function pesquisarEntrada()
  {
    $produtos_em_estoque = DB::table('produto_em_estoques')->get();
    $produtos = [];
    $query = "";
    if(isset($_GET['query'])) $query = $_GET['query'];

    if(!$query) {
      return false;
    }

    //pesquisa entradas de acordo com a query teste
    $produtos_id = Produto::where('nome', 'LIKE', "%"."$query"."%")->get();
    foreach($produtos_id as $produto) {
      $produtos_filtrados = Produto_em_estoque::where('Id_produto', 'LIKE', '%'.$produto->id.'%')->get();
      foreach($produtos_filtrados as $produto) {
        $produto->nome = Produto::findOrFail($produto->Id_produto)->nome;
        $produto->marca = Produto::findOrFail($produto->Id_produto)->marca;
        $produto->estoque = Estoque_disponivel::findOrFail($produto->Id_estoque)->estoque;
        array_push($produtos, $produto);
      }
    }
    

    //pesquisa os produtos sem estoque
    $produto_id = Produto::where('nome', 'LIKE', "%"."$query"."%")->get();
    foreach($produto_id as $produto) {
      if(Produto_em_estoque::where('Id_produto', $produto->id)->exists() == false) {
        if($query[0] == $produto->nome[0]) array_push($produtos, $produto);
      }
    }
    
    return $produtos;
  }

  // function pesquisarEntrada()
  // {
  //   $produtos_cadastrados = DB::table('produtos')->get();
  //   $query = "feijã";
  //   if((DB::table('produto_em_estoques')->where('Id_produto', $produto->id)->exists()) == false)
  //   $data = Produto::where('nome', 'LIKE', '%'.$query.'%')->get();
  //   return $data;
  // }
}
