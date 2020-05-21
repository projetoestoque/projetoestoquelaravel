<?php

use Illuminate\Database\Seeder;
use App\Estoque_disponivel;

class EstoqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estoques = [
            [
              'estoque' => 'sem estoque'
            ],
            [
              'estoque' => 'despensa'
            ],
            [
              'estoque' => 'almoxarifado'
            ]
          ];

          foreach($estoques as $estoque => $value){
            Estoque_disponivel::create($value);
          }
    }
}
