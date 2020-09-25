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
              'Id_doador' => 2,
              'Id_produto' => 2,
              'Id_entrada' => 1,
              'tipo' => 'entrada',
              'data' => date('Y-m-d'),
              'usuario' => 'admin',
              'quantidade' => "50",
              'vencimento' => date('Y-m-d', strtotime('+2 week'))
            ],
            [
              'Id_doador' => 2,
              'Id_produto' => 1,
              'Id_entrada' => 2,
              'tipo' => 'entrada',
              'data' => date('Y-m-d'),
              'usuario' => 'admin',
              'quantidade' => "4",
              'vencimento' => date('Y-m-d', strtotime('+2 week'))
            ],
          ];

          foreach($relatorios as $relatorio => $value){
            Relatorio::create($value);
          }
    }
}
