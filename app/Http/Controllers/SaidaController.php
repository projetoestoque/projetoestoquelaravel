<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Produto_em_estoque;
use App\Estoque_disponivel;
use App\Medida;
use App\Doador;
use App\Relatorio;
use DB;

class SaidaController extends Controller
{
    public function index(){
      $produtos_em_estoque = DB::table('produto_em_estoques')->get();
      $produtos_estoque = [];

      if(isset($_GET['id']) && $_GET['id'] != "") {

        foreach($produtos_em_estoque as $produto) {
          $produto->medida = Medida::find($produto->Id_medida)->medida;
          $produto_estoque = $produto;
          $produto_estoque->tipo = Produto::find($produto->Id_produto)->tipo;
          $produto_estoque->nome = Produto::find($produto->Id_produto)->nome;
          $produto_estoque->estoque = Estoque_disponivel::find($produto->Id_estoque);
          $produto_estoque->marca = Produto::find($produto->Id_produto)->marca;
          $produto_estoque->abreviacao = Medida::find($produto->Id_medida)->abreviacao;
          array_push($produtos_estoque, $produto_estoque);
        }

        foreach($produtos_estoque as $produto) {
          if($produto->id == $_GET['id']) {
            $entrada = $produto;
          }
        }
        return view('saida', compact('entrada'));
      }
      return view('saida');
    }

    public function saida(Request $req){
        $entrada = Produto_em_estoque::find($req->get('Id_entrada'));
        $produto_da_entrada = Produto::find($entrada->Id_produto);
        $doador_da_entrada = Doador::find($entrada->Id_doador);

        if($entrada->quantidade - $req->get('quantidade') > 0) {
          $entrada->quantidade -= $req->get('quantidade');
          $restando = $entrada->quantidade;
          $entrada->save();
          $doado_em = explode(" ", $entrada->created_at)[0];
          $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
        } else {
          $entrada->delete();
          $restando = 0;
        }
        
        $relatorio = new Relatorio();
        $relatorio->tipo = "saida";
        $relatorio->data = date('Y-m-d');
        $relatorio->Id_produto = $produto_da_entrada->id;
        $relatorio->Id_entrada = $entrada->id;
        $relatorio->Id_doador = $doador_da_entrada->id;

        if(auth()->user()->is_admin) {
          $relatorio->usuario = "admin";
        } else {
          $relatorio->usuario = "supervisor";
        }

        $relatorio->quantidade = $req->get('quantidade');
        $relatorio->resto = $restando;
        $relatorio->save();

        return redirect()->route('saida')->with('status', 'Saída realizada com sucesso!');
    }

    public function carregar() {
      $produtos_em_estoque = DB::table('produto_em_estoques')->get();
      $produtos_estoque = [];

      foreach($produtos_em_estoque as $produto) {
        $entrada = new Produto();
        $entrada->nome = Produto::find($produto->Id_produto)->nome;
        $entrada->quantidade = $produto->quantidade . Medida::find($produto->Id_medida)->abreviacao;
        $entrada->tipo = Produto::find($produto->Id_produto)->tipo;
        $entrada->marca = Produto::find($produto->Id_produto)->marca;
        $entrada->vencimento = $produto->vencimento;
        $entrada->id = $produto->id;
    
        array_push($produtos_estoque, $entrada);
      }

      $data = [
        'saida' => $produtos_estoque
      ];

      return $data;
    }

    public function pesquisar_saida() {
      sleep(0.5);
      $produtos_em_estoque = DB::table('produto_em_estoques')->get();
      $produtos_estoque = [];
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

        $produtos_filtrados = Produto_em_estoque::where('Id_produto', $produto->id)->get();

        foreach($produtos_filtrados as $produto) {
            $entrada = new Produto_em_estoque();
            $entrada->nome = Produto::findOrFail($produto->Id_produto)->nome;
            $entrada->quantidade = $produto->quantidade.Medida::findOrFail($produto->Id_medida)->abreviacao;
            $entrada->tipo = Produto::find($produto->Id_produto)->tipo;
            $entrada->marca = Produto::findOrFail($produto->Id_produto)->marca;
            $entrada->vencimento = $produto->vencimento;
            $entrada->id = $produto->id;
           
            array_push($produtos_estoque, $entrada);
        }
      }

      $data = [
        'saida' => $produtos_estoque
      ];

      return $data;
    }

    public function menu(){
        return view('menuSaida');
    }
}
