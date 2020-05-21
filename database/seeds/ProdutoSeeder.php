<?php

use Illuminate\Database\Seeder;
use App\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produtos = [
            [
              'nome' => 'feijão preto',
              'codigo_barra' => '111111111111',
              'tipo' => 'Alimento',
              'marca' => 'tio jõao'
            ],
            [
                'nome' => 'arroz',
                'codigo_barra' => '222222222222',
                'tipo' => 'Alimento',
                'marca' => 'tio jõao'
            ],
            [
                'nome' => 'Folha sulfite',
                'codigo_barra' => '333333333333',
                'tipo' => 'Escritorio',
                'marca' => 'hp'
            ]
          ];

          foreach($produtos as $produto => $value){
            Produto::create($value);
          }
    }
}
