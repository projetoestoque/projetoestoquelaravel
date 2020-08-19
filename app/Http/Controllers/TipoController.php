<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;

class TipoController extends Controller
{
  public function listar_tipos()
    {
        $tipos_cadastrados=DB::table('tipos')->orderBy('tipo')->get();

        return view('listagem', compact('tipos_cadastrados'));
    }

  public function atualizarTipo(Request $req)
  {
    $tipo_id = $req->get('id');
    $tipo = Tipo::findOrFail($tipo_id);
    $tipo->tipo = $req->get('tipo');
    $tipo->save();
    return redirect()->route('admin.listarCadastros', ['rel' => 'tipo'])->with('status', 'Tipo atualizado com sucesso!');
  }

  public function deletarTipo()
  {
      $tipo_id = $_GET['id'];
      $tipo = Tipo::findOrFail($tipo_id);
      $tipo->delete();
      return redirect()->route('admin.listarCadastros', ['rel' => 'tipo'])->with('status', 'Tipo deletado com sucesso!');
  }
}
