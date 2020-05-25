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
    return redirect()->route('admin.cadastros')->with('status', 'Estoque atualizado com sucesso!');
  }

  public function deletarEstoque()
  {
      $estoque_id = $_GET['id'];
      $estoque = Estoque::find($estoque_id);
      $estoque->delete();
      return redirect()->back()->with('status', 'Estoque deletado com sucesso!');
  }
}
