<?php

use Illuminate\Database\Seeder;
use App\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
          [
            'tipo' => 'Escritorio'
          ],
          [
            'tipo' => 'Alimento'
          ],
          [
            'tipo' => 'Higiene'
          ],
          [
            'tipo' => 'Limpeza'
          ],
          [
            'tipo' => 'Material Escolar'
          ]
        ];

        foreach($tipos as $tipo => $value){

          Tipo::create($value);
        }
    }
}
