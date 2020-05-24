<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doador;
use DB;


class DoadorController extends Controller
{
  public function deletarDoador()
{
      $doador_id = $_GET['id'];
      $doador = Doador::find($doador_id);
      $doador->delete();
      return redirect()->back()->with('status', 'Doador deletado com sucesso!');
  }
}
