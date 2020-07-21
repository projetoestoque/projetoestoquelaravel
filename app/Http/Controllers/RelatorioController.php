<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index(){
        return view('relatorio');
    }

    public function gerarRelatorio(Request $req) {
        date_default_timezone_set('America/Sao_Paulo');

        switch($req->get('tipo')) {
            case 'geral':
                switch($req->get('periodo')) {
                    case 'dia':
                        $hoje = date('Y-m-d');
                        $relatorios = DB::table('relatorios')->where('data', $hoje)->where('tipo','geral')->get();
                        foreach($relatorio as $relatorios) {
                            $relatorio_saida += $relatorio->relatorio;
                        }
                    break;
                    case 'semana':

                    break;
                    case 'mes':

                    break;
                    case 'ano':

                    break;
                }
            break;
            case 'entrada':
                case 'dia':

                break;
                case 'semana':

                break;
                case 'mes':

                break;
                case 'ano':

                break;
            break;
            case 'vencimento':
                case 'dia':

                break;
                case 'semana':

                break;
                case 'mes':

                break;
                case 'ano':

                break;
            break;
            case 'baixa':
                case 'dia':

                break;
                case 'semana':

                break;
                case 'mes':

                break;
                case 'ano':

                break;
            break;
        }
    }
}
