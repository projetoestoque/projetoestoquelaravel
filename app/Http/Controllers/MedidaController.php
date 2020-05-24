<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedidaController extends Controller
{
  public function deletarMedida()
{
      $medida_id = $_GET['id'];
      $medida = Medida::find($medida_id);
      $medida->delete();
      return redirect()->back()->with('status', 'Medida deletada com sucesso!');
  }
}
