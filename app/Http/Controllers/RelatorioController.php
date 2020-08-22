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


    function gerarRelatorio(Request $req) {
        date_default_timezone_set('America/Sao_Paulo');
        $relatorio_texto = [];
        $relatorios = [];
        $retorno = [];
        $entrada_texto = [];
        $saida_texto = [];
        $vencimento_texto = [];
        $estoque_texto = [];
        $data_inicial = implode('/', array_reverse(explode('/', $req->get('data_inicial'))));
        $data_final = implode('/', array_reverse(explode('/', $req->get('data_inicial'))));

        //atualizar entradas em baixo ou se vencendo
        $output = shell_exec('cd .. && php artisan verificar:produtos');

        if($req->get('tipo') != "geral") {
            $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo', $req->get('tipo'))->get();
            
            foreach($relatorios as $relatorio) {
                array_push($relatorio_texto, $relatorio->relatorio);
            }

            if(count($relatorio_texto) == 0) {
                return "Impossivel gerar PDF, sem relatorio desse tipo no periodo!";
            }

            array_push($retorno, ['tipo' => $req->get('tipo'), 'texto' => $relatorio_texto]);

        } else {
            //parte de entrada
            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"entrada")->exists()) {
                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"entrada")->get();
               
                foreach($relatorios as $relatorio) {
                    array_push($entrada_texto, $relatorio->relatorio);
                }

                array_push($retorno, ["tipo" => "Entrada","texto" => $entrada_texto]);
            }

            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"saida")->exists()) {
                
                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"saida")->get();
                foreach($relatorios as $relatorio) {
                    array_push($saida_texto, $relatorio->relatorio);
                }
                array_push($retorno, ["tipo" => "Saída", "texto" => $saida_texto]);
            }

            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"vencimento")->exists()) {
                
                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"vencimento")->get();
               
                foreach($relatorios as $relatorio) {
                    array_push($vencimento_texto, $relatorio->relatorio);
                }
                array_push($retorno, ["tipo" => "Produtos em vencimento", "texto" => $vencimento_texto]);
            }

            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"baixa")->exists()) {
               
                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"baixa")->get();
                foreach($relatorios as $relatorio) {
                    array_push($estoque_texto, $relatorio->relatorio);
                }
                array_push($retorno, ["tipo" => "Produtos com estoque baixo", "texto" => $estoque_texto]);
            }
        }
        
        
        return \PDF::loadView('relatorio_pdf', compact('retorno'))
            ->setPaper('a4', 'landscape')
            ->stream();
            // ->download('relatorio_'.date('d-m-Y_h:i:s').'.pdf');
    }

}
