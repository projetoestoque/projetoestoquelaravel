<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doador;
use DB;


class DoadorController extends Controller
{
  public function listar_doadores()
    {
        $doadores_cadastrados=DB::table('doadors')->orderBy('nome')->get();

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

    return redirect()->route('admin.listarCadastros', ['rel' => 'doador'])->with('status', 'Doador atualizado com sucesso!');
  }

  public function deletarDoador()
  {
      $doador_id = $_GET['id'];
      $doador = Doador::find($doador_id);
      
      if(DB::table('produto_em_estoques')->where('Id_doador', $doador_id)->exists()) {
        return redirect()->back()->withErrors(['errors' => ['Doador não pode ser deletado pois possui um produto vinculado ao seu nome!']]);
      } else {
        $doador->delete();
        return redirect()->route('admin.listarCadastros', ['rel' => 'doador'])->with('status', 'Doador deletado com sucesso!');
      }

      
  }
}
