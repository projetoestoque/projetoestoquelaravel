<?php

use Illuminate\Database\Seeder;
use App\Produto_em_estoque;

class EntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entradas = [
            [
              'Id_estoque' => 2,
              'Id_produto' => 2,
              'Id_medida' => 2,
              'Id_doador' => 2,
              'quantidade' => 50,
              'quantidade_minima' => 5,
              'vencimento' => date('Y-m-d', strtotime('+2 week'))
            ],
            [
                'Id_estoque' => 2,
                'Id_produto' => 1,
                'Id_medida' => 2,
                'Id_doador' => 2,
                'quantidade' => 4,
                'quantidade_minima' => 5,
                'vencimento' => '20/06/2002'
            ]
          ];

          foreach($entradas as $entrada => $value){
            Produto_em_estoque::create($value);
          }
    }
}
