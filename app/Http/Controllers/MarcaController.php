<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use DB;

class MarcaController extends Controller
{
  public function deletarMarca()
{
      $marca_id = $_GET['id'];
      $marca = Marca::find($marca_id);
      $marca->delete();
      return redirect()->back()->with('status', 'Marca deletada com sucesso!');
  }
}
