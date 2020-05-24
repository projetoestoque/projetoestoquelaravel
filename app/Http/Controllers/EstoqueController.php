<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doador;
use DB;

class EstoqueController extends Controller
{
  public function deletarEstoque()
{
      $estoque_id = $_GET['id'];
      $estoque = Estoque::find($estoque_id);
      $estoque->delete();
      return redirect()->back()->with('status', 'Estoque deletado com sucesso!');
  }
}
