<?php

use Illuminate\Database\Seeder;
use App\Doador;

class DoadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doadores = [
            [
              'nome' => 'sem doador',
              'email' => 'sem doador',
              'tipo' => 'sem doador'
            ],
            [
                'nome' => 'doador anônimo',
                'email' => 'doador anônimo',
                'tipo' => 'doador anônimo'
            ],
            [
                'nome' => 'recursos própios',
                'email' => 'recursos própios',
                'tipo' => 'recursos própios'
            ]
          ];

          foreach($doadores as $doador => $value){
            Doador::create($value);
          }
    }
}
