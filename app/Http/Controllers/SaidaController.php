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


      if(isset($_GET['id']) && $_GET['id'] != "") {
        foreach($produtos_estoque as $produto) {
          if($produto->id == $_GET['id']) {
            $entrada = $produto;
          }
        }
        return view('saida', compact('produtos_estoque','entrada'));
      }
      return view('saida', compact('produtos_estoque'));
    }

    public function saida(Request $req){
        $entrada = Produto_em_estoque::find($req->get('Id_entrada'));
        $produto_da_entrada = Produto::find($entrada->Id_produto);
        $doador_da_entrada = Doador::find($entrada->Id_doador);

        if($entrada->quantidade - $req->get('quantidade') > 0) {
          $entrada->quantidade -= $req->get('quantidade');
          $entrada->save();
          $relatorio_modelo = "Saída de ".$req->get('quantidade') . Medida::find($entrada->Id_medida)->abreviacao . " " . Produto::find($entrada->Id_produto)->nome . " " . Produto::find($entrada->Id_produto)->marca ." em ".date('d-m-Y') .", doado pelo(a) ". (Doador::find($entrada->Id_doador)->nome == null?Doador::find($entrada->Id_doador)->instituicao:Doador::find($entrada->Id_doador)->nome) ." de cpf/cnpj ". (Doador::find($entrada->Id_doador)->nome == null?Doador::find($entrada->Id_doador)->cnpj:Doador::find($entrada->Id_doador)->cpf) ." em ". $entrada->created_at ." restando ".$entrada->quantidade . Medida::findOrFail($entrada->Id_medida)->abreviacao ." da entrada.";
        } else {
          $relatorio_modelo = "Saída de ".$req->get('quantidade') . Medida::find($entrada->Id_medida)->abreviacao . " " . Produto::find($entrada->Id_produto)->nome . " " . Produto::find($entrada->Id_produto)->marca ." em ".date('d-m-Y') .", doado pelo(a) ". (Doador::find($entrada->Id_doador)->nome == null?Doador::find($entrada->Id_doador)->instituicao:Doador::find($entrada->Id_doador)->nome) ." de cpf/cnpj ". (Doador::find($entrada->Id_doador)->nome == null?Doador::find($entrada->Id_doador)->cnpj:Doador::find($entrada->Id_doador)->cpf) ." em ". $entrada->created_at ." restando nada da entrada";
          $entrada->delete();
        }
        
        $relatorio = new Relatorio();
        $relatorio->tipo = "saida";
        $relatorio->data = date('Y-m-d');
        $relatorio->relatorio = $relatorio_modelo;
        $relatorio->Id_produto = $produto_da_entrada->id;
        $relatorio->Id_entrada = $entrada->id;
        $relatorio->Id_doador = $doador_da_entrada->id;
        $relatorio->save();

        return redirect()->route('saida')->with('status', 'Saída realizada com sucesso!');
    }
}
