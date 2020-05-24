<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoController extends Controller
{
  public function deletarTipo()
{
      $tipo_id = $_GET['id'];
      $tipo = Tipo::find($tipo_id);
      $tipo->delete();
      return redirect()->back()->with('status', 'Tipo deletado com sucesso!');
  }
}
