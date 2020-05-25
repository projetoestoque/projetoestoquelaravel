<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use DB;

class MarcaController extends Controller

{

  public function atualizarMarca(Request $req)
  {
    $marca_id = $req->get('id');
    $marca = Marca::findOrFail($marca_id);
    $marca->marca = $req->get('marca');
    $marca->save();
    return redirect()->route('admin.cadastros')->with('status', 'Marca atualizada com sucesso!');
  }

  public function deletarMarca()
  {
    $marca_id = $_GET['id'];
    $marca = Marca::find($marca_id);
    $marca->delete();
    return redirect()->back()->with('status', 'Marca deletada com sucesso!');
  }
}
