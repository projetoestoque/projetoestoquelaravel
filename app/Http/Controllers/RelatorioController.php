<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto_em_estoque;
use DB;

class RelatorioController extends Controller
{
    public function index(){
        return view('relatorio');
    }

    public function gerarRelatorio(Request $req) {
        date_default_timezone_set('America/Sao_Paulo');
        $relatorio_texto = "";
        $relatorios = [];
        
        //definir as datas do periodo
        switch($req->get('data')) {
            case 'hoje':
                $data_inicial = date('Y-m-d');
                $data_final = $data_inicial;
            break;
            case 'semana':
                $data_inicial = date('Y-m-d', strtotime('-1 week'));
                $data_final = date("Y-m-d");
            break;
            case 'mes':
                $data_inicial = date('Y-m-d', strtotime('-4 week'));
                $data_final = date("Y-m-d");
            break;
            case 'ano':
                $data_inicial = date('Y-m-d', strtotime('-12 week'));
                $data_final = date("Y-m-d");
            break;
        }

        $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo', $req->get('tipo'))->get();

        
        if(count($relatorios) != 0) {
            $relatorio_texto .= strtoupper($req->get('tipo')). "S\n\n";
        }
        
        foreach($relatorios as $relatorio) {
            $relatorio_texto .= "$relatorio->relatorio\n";
        }

        if($relatorio_texto == "") {
            return "Sem relatorio desse tipo no periodo!";
        }
                
        return $relatorio_texto;
        
    }
}
