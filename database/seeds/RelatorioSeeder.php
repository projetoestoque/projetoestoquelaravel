<?php

use Illuminate\Database\Seeder;
use App\Relatorio;

class RelatorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relatorios = [
            [
              'Id_doador' => 1,
              'Id_produto' => 1,
              'Id_entrada' => 1,
              'tipo' => 'saida',
              'data' => date('Y-m-d', strtotime('-1 week')),
              'usuario' => 'admin',
              'quantidade' => "5",
              'vencimento' => "00/00/0000",
              'resto' => "8"
            ],
            [
              'Id_doador' => 1,
              'Id_produto' => 1,
              'Id_entrada' => 1,
              'tipo' => 'entrada',
              'data' => date('Y-m-d', strtotime('-1 week')),
              'usuario' => 'supervisor',
              'quantidade' => "16",
              'vencimento' => "00/00/0000",
            ],
            [
              'Id_doador' => 1,
              'Id_produto' => 1,
              'Id_entrada' => 1,
              'tipo' => 'baixa',
              'data' => date('Y-m-d', strtotime('-1 week')),
              'usuario' => 'admin,',
              'vencimento' => "00/00/0000",
              'resto' => '2',
              'quantidade_minima' => '5'
            ]
          ];

          foreach($relatorios as $relatorio => $value){
            Relatorio::create($value);
          }
    }
}
