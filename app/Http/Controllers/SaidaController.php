<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SaidaController extends Controller
{
    public function index(){
        return view('saida');
    }

    public function saida(Request $req){
        $entrada = DB::find($req->get('id'));
        $entrada->quantidade -= $req->get('quantidade');
        $relatorio = new Relatorio();
        $relatorio->tipo="saida";
        $relatorio->data = date('Y-m-d');
        $relatorio_modelo = "";
        if($entrada->quantidade>0){
          $relatorio_modelo = "Saída de $req->get('quantidade') $req->get('medida') de $req->get('produto') $req->get('marca') em $req->get('data'), doado pelo(a) $req->get('doador_nome') de cpf/cnpj $req->get('cpf') $req->get('cnpj') em $req->get('data_entrada') restando $get->get('quantidade') $req->get('medida') da entrada."
        }else{
          $relatorio_modelo = "Saída de $req->get('quantidade') $req->get('medida') de $req->get('produto') $req->get('marca') em $req->get('data'), doado pelo(a) $req->get('doador_nome') de cpf/cnpj $req->get('cpf') $req->get('cnpj') em $req->get('data_entrada') restando $get->get('quantidade') $req->get('medida') da entrada."
          $entrada->delete();
        }
        $relatorio->relatorio=$relatorio_modelo;
        $relatorio->save();
    }
}
