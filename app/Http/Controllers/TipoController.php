<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;

class TipoController extends Controller
{
  public function atualizarTipo(Request $req)
  {
    $tipo_id = $req->get('id');
    $tipo = Tipo::findOrFail($tipo_id);
    $tipo->tipo = $req->get('tipo');
    $tipo->save();
    return redirect()->route('admin.cadastros')->with('status', 'Tipo atualizado com sucesso!');
  }

  public function deletarTipo()
  {
      $tipo_id = $_GET['id'];
      $tipo = Tipo::find($tipo_id);
      $tipo->delete();
      return redirect()->back()->with('status', 'Tipo deletado com sucesso!');
  }
}
