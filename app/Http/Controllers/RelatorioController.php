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
            $ids_produtos = explode(";", $_GET['produto']);
            $produtos = [];

            for($i = 0; $i < count($ids_produtos); $i++) {
                $produto = Produto::findOrFail($ids_produtos[$i]);
                array_push($produtos, $produto);
            }
            
            return view('relatorio', compact('produtos'));
        }
        return view('relatorio');
    }


    function gerarRelatorio(Request $req) {

        date_default_timezone_set('America/Sao_Paulo');
        $data_inicial = implode('-', array_reverse(explode('/', $req->get('data_inicial'))));
        $data_final = implode('-', array_reverse(explode('/', $req->get('data_final'))));

        $ong = Ong::findOrFail(1);

        //define o parametro produto de data/filtragem
        $data_filtragem_produto = [];
        if($req->get('produto')[0] == "todos") {
            array_push($data_filtragem_produto, "Todos");
        } else {
            for($i = 0; $i < count($req->get('produto')); $i++ ) {
                array_push($data_filtragem_produto, Produto::findOrFail($req->get('produto')[$i])->nome);
            }
        }
        
        
        //define o parametro usuario de data/filtragem
        $data_filtragem_usuario = [];
        for($i = 0; $i < count($req->get('usuario')); $i++ ) {
            array_push($data_filtragem_usuario, $req->get('usuario')[$i]);
        }

         //define o parametro tipo de data/filtragem
         $data_filtragem_tipo = [];
         for($i = 0; $i < count($req->get('tipo')); $i++ ) {
             array_push($data_filtragem_tipo, $req->get('tipo')[$i]);
         }

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
                "usuario" => $data_filtragem_usuario,
                "produto" => $data_filtragem_produto,
                "tipo" => $data_filtragem_tipo
            ],
            "relatorio" => [
                "entrada" => [],
                "saida" => [],
                "vencimento" => [],
                "baixa" => [],
                "em_dia" => [],
                "sem_estoque" => []
            ]
        ];

        //wheres adicionais
        $wheres = [];

        if($req->get('usuario')[0] != "ambos") {
            for($i = 0; $i < count($req->get('usuario')); $i++ ) {
                array_push($wheres, ['usuario', '=', $req->get('usuario')[$i]]);
            }
        }

        //atualizar entradas em baixa, vencendo, alta ou sem estoque.
        $rel = new Relatorio();
        $rel->verificarProdutos();

        $tipos = [];
        
        if($req->get('tipo')[0] != "geral") {
            $tipos = $req->get('tipo');
        } else {
            $tipos = [
                'entrada',
                'saida',
                'baixa',
                'vencimento',
                'em_dia',
                'sem_estoque'
            ];
        }

        foreach($tipos as $tipo) {

            if($req->get('produto')[0] != "todos") {

                foreach($req->get('produto') as $produto) {
                    if(DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo', $tipo)->where('Id_produto', $produto)->where($wheres)->exists()) {
                        
                        $relatorios = DB::table('relatorios')->whereBetween('data', [$data_inicial, $data_final])->where('tipo', $tipo)->where('Id_produto', $produto)->where($wheres)->get();
                        
                        foreach($relatorios as $relatorio) {

                            $dados = [
                                "produto" => Produto::findOrFail($relatorio->Id_produto)->nome,
                                "marca" => Produto::findOrFail($relatorio->Id_produto)->marca,
                                "data_acao" => date('d/m/Y', strtotime($relatorio->data)),
                                "doador" => (Doador::findOrFail($relatorio->Id_doador)->nome == null ? Doador::findOrFail($relatorio->Id_doador)->instituicao:Doador::findOrFail($relatorio->Id_doador)->nome),
                            ];

                            switch($tipo) {
                                case 'entrada':
                                case 'em_dia':
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

            } else {
                
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
                                case 'em_dia':
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
        }

        dd($data);

        return \PDF::loadView('relatorio_pdf', compact('data'))
            ->setPaper('a4', 'portrait')
            ->stream();
            // ->download('relatorio_'.date('d-m-Y_h:i:s').'.pdf');
    }

}
