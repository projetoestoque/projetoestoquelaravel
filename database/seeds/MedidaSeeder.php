<?php

use Illuminate\Database\Seeder;
use App\Medida;

class MedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medidas = [
            [
              'medida' => 'sem medida',
              'abreviacao'=>''
            ],
            [
              'medida' => 'quilo',
              'abreviacao'=>'kg'
            ],
            [
              'medida' => 'unidade',
              'abreviacao'=>'un'
            ],
            [
              'medida' => 'caixa',
              'abreviacao'=>'cx'
            ]
          ];

          foreach($medidas as $medida => $value){
            Medida::create($value);
          }
    }
}
