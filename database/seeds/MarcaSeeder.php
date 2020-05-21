<?php

use Illuminate\Database\Seeder;
use App\Marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = [
            [
              'marca' => 'sem marca'
            ],
            [
              'marca' => 'tio jõao'
            ],
            [
              'marca' => 'ype'
            ],
            [
              'marca' => 'hp'
            ]
          ];

          foreach($marcas as $marca => $value){
            Marca::create($value);
          }
    }
}
