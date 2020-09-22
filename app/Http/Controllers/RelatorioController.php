<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto_em_estoque;
use App\Produto;
use App\Relatorio;
use App\Doador;
use App\Ong;
use App\Endereco;
use DB;

class RelatorioController extends Controller
{
    public function index(){
        if(isset($_GET['produto']) && $_GET['produto'] != "") {
            $produtos = Produto::findOrFail($_GET['produto']);
            return view('relatorio', compact('produtos'));
        }
        return view('relatorio');
    }


    function gerarRelatorio(Request $req) {
        date_default_timezone_set('America/Sao_Paulo');
        $data_inicial = implode('-', array_reverse(explode('/', $req->get('data_inicial'))));
        $data_final = implode('-', array_reverse(explode('/', $req->get('data_final'))));

        $ong = Ong::findOrFail(1);

        $data = [
            "ong" => [
                "razao_social" => $ong->razao_social, 
                "email" => $ong->email,
                "endereco" => Endereco::findOrFail($ong->Id_endereco),
                "cnpj" => $ong->cnpj,
                "telefones" => json_decode($ong->telefones),
                "logo" => $ong->imagem,
                "cor" => $ong->cor
            ],
            "filtragem" => [
                "data_inicial" => $data_inicial,
                "data_final" => $data_final,
                "usuario" => $req->get('usuario'),
                "produto" => ( $req->get('produto') == "todos" ? "Todos" : Produto::findOrFail($req->get('produto'))->nome ),
                "tipo" => $req->get('tipo')
            ],
            "relatorio" => [
                "entrada" => [],
                "saida" => [],
                "vencimento" => [],
                "baixa" => []
            ]
        ];

        //wheres adicionais
        $wheres = [];

        if($req->get('usuario') != "ambos") {
            array_push($wheres, ['usuario', '=', $req->get('usuario')]);
        }

        if($req->get('produto') != "todos") {
            array_push($wheres, ['Id_produto', '=', $req->get('produto')]);
        }

        //atualizar entradas em baixa ou se vencendo
        $output = shell_exec('cd .. && php artisan verificar:produtos');

        $tipos = [];
        
        if($req->get('tipo') != "geral") {
            $tipos = [$req->get('tipo')];
        } else {
            $tipos = [
                'entrada',
                'saida',
                'baixa',
                'vencimento'
            ];
        }

        foreach($tipos as $tipo) {
        
            

            if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo', $tipo)->where($wheres)->exists()) {
               
                $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo', $tipo)->where($wheres)->get();
                
                foreach($relatorios as $relatorio) {

                    $dados = [
                        "produto" => Produto::findOrFail($relatorio->Id_produto)->nome,
                        "marca" => Produto::findOrFail($relatorio->Id_produto)->marca,
                        "data_acao" => date('d/m/Y', strtotime($relatorio->data)),
                        "doador" => (Doador::findOrFail($relatorio->Id_doador)->nome == null ? Doador::findOrFail($relatorio->Id_doador)->instituicao:Doador::findOrFail($relatorio->Id_doador)->nome),
                    ];

                    switch($tipo) {
                        case 'entrada':
                            $dados["quantidade"] = $relatorio->quantidade;
                        break;
                        case 'saida':
                            $dados["quantidade"] = $relatorio->quantidade;
                            $dados["resto"] = $relatorio->resto;
                        break;
                        case 'vencimento':
                            $dados["resto"] = $relatorio->resto;
                        break;
                        case 'baixa':
                            $dados["resto"] = $relatorio->resto;
                            $dados["quantidade_minima"] = $relatorio->quantidade_minima;
                        break;
                    }


                    array_push($data["relatorio"][$tipo], $dados);
                }
                
            }
        }

        return \PDF::loadView('relatorio_pdf', compact('data'))
            ->setPaper('a4', 'portrait')
            ->stream();
            // ->download('relatorio_'.date('d-m-Y_h:i:s').'.pdf');
    }

}
