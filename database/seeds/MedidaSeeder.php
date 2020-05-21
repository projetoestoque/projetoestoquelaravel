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
              'medida' => 'sem medida'
            ],
            [
              'medida' => 'quilo (kg)'
            ],
            [
              'medida' => 'unidade (un)'
            ]
          ];

          foreach($medidas as $medida => $value){
            Medida::create($value);
          }
    }
}
