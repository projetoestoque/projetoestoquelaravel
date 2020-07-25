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

        //atualizar entradas em baixo ou se vencendo
        $output = shell_exec('cd .. && php artisan verificar:produtos');
        
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

        if($req->get('tipo') != "geral") {
            $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo', $req->get('tipo'))->get();
            if(count($relatorios) != 0) {
                $relatorio_texto .= strtoupper($req->get('tipo')). "S\n\n";
            }
            
            foreach($relatorios as $relatorio) {
                $relatorio_texto .= "$relatorio->relatorio\n";
            }
        } else {
            //parte de entrada
            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"entrada")->exists()) {
                $relatorio_texto .= "\nENTRADAS\n";

                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"entrada")->get();
                foreach($relatorios as $relatorio) {
                    $relatorio_texto .= "$relatorio->relatorio\n";
                }
            }

            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"saida")->exists()) {
                $relatorio_texto .= "\nSAÍDAS\n";

                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"saida")->get();
                foreach($relatorios as $relatorio) {
                    $relatorio_texto .= "$relatorio->relatorio\n";
                }
            }

            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"vencimento")->exists()) {
                $relatorio_texto .= "\nPRODUTOS EM VENCIMENTO\n";
                
                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"vencimento")->get();
               
                foreach($relatorios as $relatorio) {
                    $relatorio_texto .= "$relatorio->relatorio\n";
                }
            }

            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"baixa")->exists()) {
                $relatorio_texto .= "\nPRODUTOS COME ESTOQUE BAIXO\n";

                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo',"baixa")->get();
                foreach($relatorios as $relatorio) {
                    $relatorio_texto .= "$relatorio->relatorio\n";
                }
            }

        }
        
       

        if($relatorio_texto == "") {
            return "Sem relatorio desse tipo no periodo!";
        }

        return $relatorio_texto;
        
    }

    function gerarPdf(Request $req) {
        date_default_timezone_set('America/Sao_Paulo');
        $relatorio_texto = [];
        $relatorios = [];
        $retorno = [];
        $entrada_texto = [];
        $saida_texto = [];
        $vencimento_texto = [];
        $estoque_texto = [];


        //atualizar entradas em baixo ou se vencendo
        $output = shell_exec('cd .. && php artisan verificar:produtos');
        
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
            ->download('relatorio_'.date('d-m-Y_h:i:s'));
    }

    function gerarPrint(Request $req) {
        date_default_timezone_set('America/Sao_Paulo');
        $relatorio_texto = [];
        $relatorios = [];
        $retorno = [];
        $entrada_texto = [];
        $saida_texto = [];
        $vencimento_texto = [];
        $estoque_texto = [];


        //atualizar entradas em baixo ou se vencendo
        $output = shell_exec('cd .. && php artisan verificar:produtos');
        
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
        
        $print = $retorno;
        return view('relatorio', compact('print'));
    }
}
