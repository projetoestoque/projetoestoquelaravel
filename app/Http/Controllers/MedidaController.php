<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medida;

class MedidaController extends Controller
{
  public function listar_medidas()
    {
        $medidas_cadastradas=DB::table('medidas')->orderBy('medida')->get();

        return view('listagem', compact('medidas_cadastradas'));
    }

  public function atualizarMedida(Request $req)
  {
    $medida_id = $req->get('id');
    $medida = Medida::findOrFail($medida_id);
    $medida->medida = $req->get('medida');
    $medida->abreviacao = $req->get('abreviacao');
    $medida->save();
    return redirect()->route('admin.listarCadastros', ['rel' => 'medida'])->with('status', 'Medida atualizada com sucesso!');
  }

  public function deletarMedida()
  {
      $medida_id = $_GET['id'];
      $medida = Medida::find($medida_id);
      $medida->delete();
      return redirect()->route('admin.listarCadastros', ['rel' => 'medida'])->with('status', 'Medida deletada com sucesso!');
  }
}
