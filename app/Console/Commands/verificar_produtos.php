<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Produto;
use App\Doador;
use App\Medida;
use App\Relatorio;
use DB;

class verificar_produtos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:produtos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para verificar se o produto está em baixa ou em vencimento';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $entradas = DB::table('produto_em_estoques')->get();
        $relatorios = DB::table('relatorios')->get();
        $entrada_registrada = false;

        foreach($entradas as $entrada) {
            foreach($relatorios as $relatorio) {
                if($entrada->id == $relatorio->Id_entrada && ($relatorio->tipo == "vencimento" || $relatorio->tipo == "baixa")) {
                    echo "registrado\n";
                    $entrada_registrada = true;
                }
            }

            if($entrada_registrada == false) {
                //baixas
                if($entrada->quantidade <= $entrada->quantidade_minima) {
                    $relatorio = new Relatorio();
                    $relatorio->tipo = "baixa";
                    $relatorio->data = date('Y-m-d');
                    $doado_em = explode(" ", $entrada->created_at)[0];
                    $doado_em = implode('/', array_reverse(explode('-', $doado_em)));
                    $relatorio->Id_produto = $entrada->Id_produto;
                    $relatorio->Id_entrada = $entrada->id;
                    $relatorio->Id_doador = $entrada->Id_doador;

                    if(auth()->user()->is_admin) {
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

                    if(auth()->user()->is_admin) {
                        $relatorio->usuario = "admin";
                    } else {
                        $relatorio->usuario = "supervisor";
                    }

                    $relatorio->resto = $entrada->quantidade;
                    $relatorio1->save();
                }
            }
            $entrada_registrada = false;
        }

    }
}
