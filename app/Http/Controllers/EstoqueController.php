<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque_disponivel;
use DB;

class EstoqueController extends Controller
{
  public function listar_estoques() 
    {
        $estoques_cadastrados=DB::table('estoques')->get();

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
    $produtos_em_estoque = DB::table('produtos')->get();
    $produtos = [];
    $query = "F";
    $contador = 0;

    //varre todos os produtos em estoque e verificada cada letra
    //se for igual a da $query ele salva no array produtos xD
    foreach($produtos_em_estoque as $produto) {
        for($i = 0; $i < strlen($query); $i++) {
            if($produto->nome[$i] === $query[$i]) $contador++;
            if($contador == strlen($query)) array_push($produtos, $produto);
        }
        $contador = 0;
    }

    return $produtos;
  }
}
