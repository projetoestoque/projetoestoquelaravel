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
              'relatorio' => 'Saída de 0kg arroz tio jõao em 00/00/2020, doado pelo(a) doador anônimo de cpf/cnpj  em 25/07/2020 restando 40kg da entrada.',
              'data' => date('Y-m-d', strtotime('-1 week')),
            ],
            [
              'Id_doador' => 1,
              'Id_produto' => 1,
              'Id_entrada' => 1,
              'tipo' => 'entrada',
              'relatorio' => 'Entrada de 0  de Folha sulfite hp em 00/00/2020 doado pelo/a sem doador de cpf/cpnj com vencimento em 00/00/2020',
              'data' => date('Y-m-d', strtotime('-1 week')),
            ],
            [
              'Id_doador' => 1,
              'Id_produto' => 1,
              'Id_entrada' => 1,
              'tipo' => 'baixa',
              'relatorio' => 'Folha sulfite hp doado pelo/a sem doador de cpf/cnpj  em 00/00/2020 restando 2 dias para o vencimento do mesmo!',
              'data' => date('Y-m-d', strtotime('-1 week')),
            ]
          ];

          foreach($relatorios as $relatorio => $value){
            Relatorio::create($value);
          }
    }
}
