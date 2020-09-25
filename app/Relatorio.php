<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produto;
use App\Doador;
use App\Medida;
use DB;
use Auth;

class Relatorio extends Model
{
    protected $fillable = [
    	'tipo',  'relatorio', 'data', 'usuario'
    ];

    public function verificarProdutos ()
    {
        $entradas = DB::table('produto_em_estoques')->get();
        $relatorios = DB::table('relatorios')->get();
        $atualizacao_ids = [];
        $criar_ids = [];

        foreach($entradas as $entrada) {

            if(DB::table('relatorios')->where('Id_entrada', $entrada->id)->where("tipo", "!=", "entrada")->where("tipo", "!=", "saida")->exists()) {
                $relatorios = DB::table('relatorios')->where('Id_entrada', $entrada->id)->where("tipo", "!=", "entrada")->where("tipo", "!=", "saida")->get();
                foreach($relatorios as $relatorio) {
                    switch($relatorio->tipo) {
                        case "baixa":
                            if($entrada->quantidade <= $entrada->quantidade_minima) {
                                $relatorio = Relatorio::findOrFail($relatorio->id);
                                $relatorio->data = date('Y-m-d');
                                $doado_em = explode(" ", $entrada->created_at)[0];
                                $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
        
                                $relatorio->resto = $entrada->quantidade;
                                $relatorio->save();
                            }
                        break;
                        case "vencimento":
                            //pegar data
                            // transforma a data do formato BR para o formato americano, ANO-MES-DIA
                            $vencimento = implode('-', array_reverse(explode('/', $entrada->vencimento)));
                            $hoje = implode('-', array_reverse(explode('/', date('d/m/Y'))));

                            // converte as datas para o formato timestamp
                            $v = strtotime($vencimento); 
                            $h = strtotime($hoje);

                            // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
                            $dataFinal = ($h - $v) /86400;

                            // caso a data 2 seja menor que a data 1, multiplica o resultado por -1
                            if($dataFinal < 0)
                            $dataFinal *= -1;

                            if($dataFinal <= 5) {
                                $relatorio1 = Relatorio::findOrFail($relatorio->id);
                                $relatorio1->data = date('Y-m-d');
                                $doado_em = explode(" ", $entrada->created_at)[0];
                                $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
                                $relatorio1->resto = $entrada->quantidade;
                                $relatorio1->save();
                            }
                        break;
                        case "em_dia":
                            //pegar data
                            // transforma a data do formato BR para o formato americano, ANO-MES-DIA
                            $vencimento = implode('-', array_reverse(explode('/', $entrada->vencimento)));
                            $hoje = implode('-', array_reverse(explode('/', date('d/m/Y'))));

                            // converte as datas para o formato timestamp
                            $v = strtotime($vencimento); 
                            $h = strtotime($hoje);

                            // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
                            $dataFinal = ($h - $v) /86400;

                            // caso a data 2 seja menor que a data 1, multiplica o resultado por -1
                            if($dataFinal < 0)
                            $dataFinal *= -1;

                            if($entrada->quantidade > $entrada->quantidade_minima && $dataFinal > 5) {
                                $relatorio = Relatorio::findOrFail($relatorio->id);
                                $relatorio->data = date('Y-m-d');
                                $doado_em = explode(" ", $entrada->created_at)[0];
                                $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
                                $relatorio->quantidade = $entrada->quantidade;
        
                                $relatorio->save();
                            }
                        break;

                    }
            } 
        } else {
            if($entrada->quantidade <= $entrada->quantidade_minima) {
                $relatorio = new Relatorio();
                $relatorio->tipo = "baixa";
                $relatorio->data = date('Y-m-d');
                $doado_em = explode(" ", $entrada->created_at)[0];
                $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
                $relatorio->Id_produto = $entrada->Id_produto;
                $relatorio->Id_entrada = $entrada->id;
                $relatorio->Id_doador = $entrada->Id_doador;

                if(Auth::user()->is_admin == TRUE) {
                    $relatorio->usuario = "admin";
                } else {
                    $relatorio->usuario = "supervisor";
                }

                $relatorio->resto = $entrada->quantidade;
                $relatorio->quantidade_minima = $entrada->quantidade_minima;
                $relatorio->save();
            }

            //vencimentos
            //pegar data
                // transforma a data do formato BR para o formato americano, ANO-MES-DIA
                $vencimento = implode('-', array_reverse(explode('/', $entrada->vencimento)));
                $hoje = implode('-', array_reverse(explode('/', date('d/m/Y'))));

                // converte as datas para o formato timestamp
                $v = strtotime($vencimento); 
                $h = strtotime($hoje);

                // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
                $dataFinal = ($h - $v) /86400;

                // caso a data 2 seja menor que a data 1, multiplica o resultado por -1
                if($dataFinal < 0)
                $dataFinal *= -1;

            if($dataFinal <= 5) {
                $relatorio1 = new Relatorio();
                $relatorio1->tipo = "vencimento";
                $relatorio1->data = date('Y-m-d');
                $doado_em = explode(" ", $entrada->created_at)[0];
                $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
                $relatorio1->Id_produto = $entrada->Id_produto;
                $relatorio1->Id_entrada = $entrada->id;
                $relatorio1->Id_doador = $entrada->Id_doador;

                if(Auth::user()->is_admin == TRUE) {
                    $relatorio1->usuario = "admin";
                } else {
                    $relatorio1->usuario = "supervisor";
                }

                $relatorio1->resto = $entrada->quantidade;
                $relatorio1->save();
            }

            //entradas em dia
            if($entrada->quantidade > $entrada->quantidade_minima && $dataFinal > 5) {
                $relatorio = new Relatorio();
                $relatorio->tipo = "em_dia";
                $relatorio->data = date('Y-m-d');
                $doado_em = explode(" ", $entrada->created_at)[0];
                $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
                $relatorio->Id_produto = $entrada->Id_produto;
                $relatorio->Id_entrada = $entrada->id;
                $relatorio->Id_doador = $entrada->Id_doador;
                $relatorio->quantidade = $entrada->quantidade;

                if(Auth::user()->is_admin == TRUE) {
                    $relatorio->usuario = "admin";
                } else {
                    $relatorio->usuario = "supervisor";
                }

                $relatorio->save();
            }

            //produtos sem estoque
            $produtos_cadastrados = DB::table('produtos')->get();
            foreach($produtos_cadastrados as $produto) {

                if( (DB::table('produto_em_estoques')->where('Id_produto', $produto->id)->exists()) == false && (DB::table('relatorios')->where('Id_produto', $produto->id)->exists()) == false ){
                    $relatorio = new Relatorio();
                    $relatorio->tipo = "sem_estoque";
                    $relatorio->data = date('Y-m-d');
                    $relatorio->Id_produto = $produto->id;
                    $relatorio->Id_doador = 1;

                    if(Auth::user()->is_admin == TRUE) {
                        $relatorio->usuario = "admin";
                    } else {
                        $relatorio->usuario = "supervisor";
                    }

                    $relatorio->save();
                }
            }
        }
    }

    }
}
