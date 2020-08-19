<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque_disponivel;
use App\Produto;
use App\Produto_em_estoque;
use App\Marca;
use App\Medida;
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
    return redirect()->route('admin.listarCadastros', ['rel' => 'estoque'])->with('status', 'Estoque atualizado com sucesso!');
  }

  public function deletarEstoque()
  {
      $estoque_id = $_GET['id'];
      $estoque = Estoque_disponivel::find($estoque_id);
      $estoque->delete();
      return redirect()->route('admin.listarCadastros', ['rel' => 'estoque'])->with('status', 'Estoque deletado com sucesso!');
  }

  public function pesquisarEntrada()
  {
    sleep(0.5);
    $produtos_em_estoque = DB::table('produto_em_estoques')->get();
    $produtos_sem = [];
    $produtos_estoque = [];
    $produtos_acima = [];
    $produtos_abaixo = [];
    $query = "";
    if(isset($_GET['query'])) $query = mb_strtolower($_GET['query'], 'UTF-8');

    if(!$query) {
      return false;
    }

    //pesquisa entradas de acordo com a query
    $todos_os_produtos = DB::table('produtos')->get();
    $produtos_id = [];
    $nome_buscado = "";
    
    foreach($todos_os_produtos as $produto) {
      $produto->nome = mb_strtolower($produto->nome, 'UTF-8');

			for($i = 0; $i < strlen($query); $i++) {
        if($i > (strlen($produto->nome) - 1)) {
          break;
        }
				$nome_buscado .= $produto->nome[$i];
			}

			if($nome_buscado == $query) {
				array_push($produtos_id, $produto);
			}

			$nome_buscado = "";
    }

    foreach($produtos_id as $produto) {
      $produtos_filtrados = Produto_em_estoque::where('Id_produto', 'LIKE', '%'.$produto->id.'%')->get();
      foreach($produtos_filtrados as $produto) {
          $entrada = new Produto_em_estoque();
          $entrada->nome = Produto::findOrFail($produto->Id_produto)->nome;
          $entrada->marca = Produto::findOrFail($produto->Id_produto)->marca;
          $entrada->quantidade = $produto->quantidade.Medida::findOrFail($produto->Id_medida)->abreviacao;
          $entrada->estoque = Estoque_disponivel::findOrFail($produto->Id_estoque)->estoque;
          $entrada->vencimento = $produto->vencimento;
          $entrada->vencendo = false;
          $entrada->faltando = false;

          // transforma a data do formato BR para o formato americano, ANO-MES-DIA
          $vencimento = implode('-', array_reverse(explode('/', $produto->vencimento)));
          $hoje = implode('-', array_reverse(explode('/', date('d/m/Y'))));

          // converte as datas para o formato timestamp
          $v = strtotime($vencimento); 
          $h = strtotime($hoje);

          // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
          $dataFinal = ($h - $v) /86400;

          // caso a data 2 seja menor que a data 1, multiplica o resultado por -1
          if($dataFinal < 0)
          $dataFinal *= -1;

          if($produto->quantidade <= $produto->quantidade_minima) $entrada->acabando = true;
          if($dataFinal <= 5) $entrada->vencendo = true;
        
          if($produto->quantidade > $produto->quantidade_minima && $dataFinal > 5) {
            array_push($produtos_acima, $entrada);
          }

          if($produto->quantidade <= $produto->quantidade_minima || $dataFinal <= 5) {
            array_push($produtos_abaixo, $entrada);
          }

          array_push($produtos_estoque, $entrada);
      }
    }
    
    //pesquisa os produtos sem estoque
    $produtos_filtrados = [];
    $produto_id = [];

    foreach($todos_os_produtos as $produto) {
      $produto->nome = mb_strtolower($produto->nome, 'UTF-8');
      

			for($i = 0; $i < strlen($query); $i++) {
        if($i > (strlen($produto->nome) - 1)) {
          break;
        }
				$nome_buscado .= $produto->nome[$i];
			}

			if($nome_buscado == $query) {
				array_push($produto_id, $produto);
			}

			$nome_buscado = "";
    }

    foreach($produto_id as $produto) {
      if(Produto_em_estoque::where('Id_produto', $produto->id)->exists() == false) {
        $produto_sem = new Produto();
        $produto_sem->nome = $produto->nome;
        $produto_sem->marca = $produto->marca;
        $produto_sem->codigo_barra = $produto->codigo_barra;
        $produto_sem->tipo = $produto->tipo;
        if($query[0] == $produto->nome[0]) array_push($produtos_sem, $produto_sem);
      }
    }

    $data = ['estoque' => $produtos_estoque, 'acima' => $produtos_acima, 'abaixo' => $produtos_abaixo, 'sem' => $produtos_sem];
    return $data;
  }
}
