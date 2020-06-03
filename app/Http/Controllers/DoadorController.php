<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doador;
use DB;


class DoadorController extends Controller
{
  public function listar_doadores() 
    {
        $doadores_cadastrados=DB::table('doadors')->get();

        return view('listagem', compact('doadores_cadastrados'));
    }

  public function atualizarDoador(Request $req)
  {
    $doador_id = $req->get('id');
    $doador = Doador::find($doador_id);
    
    if($doador->tipo == "fisico") {
      $doador->nome = $req->get('nome');
      $doador->cpf = $req->get('cpf');
      $doador->telefone = $req->get('telefone_fisico');
      $doador->email = $req->get('email_fisico');
      $doador->tipo = $req->get('tipo');
      $doador->save();

    } else {
      $doador->instituicao = $req->get('instituicao');
      $doador->cnpj = $req->get('cnpj');
      $doador->telefone = $req->get('telefone_juridico');
      $doador->email = $req->get('email_juridico');
      $doador->tipo = $req->get('tipo');
      $doador->save();
    }

    return redirect()->route('admin.cadastros')->with('update', 'Doador atualizado com sucesso!');
  }

  public function deletarDoador()
  {
      $doador_id = $_GET['id'];
      $doador = Doador::find($doador_id);
      $doador->delete();
      return redirect()->back()->with('status', 'Doador deletado com sucesso!');
  }
}
