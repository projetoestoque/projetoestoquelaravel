<?php

use Illuminate\Database\Seeder;
use App\Marca;
use App\Estoque_disponivel;
use App\Medida;

class PadraoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //default marca
        $marca = new Marca();
        $marca->marca = "sem marca";
        $marca->save();

        //default estoque
        $estoque = new Estoque_disponivel();
        $estoque->estoque = "sem estoque";
        $estoque->save();

        //default medida
        $medida = new Medida();
        $medida->medida = "sem medida";
        $medida->save();
    }
}
