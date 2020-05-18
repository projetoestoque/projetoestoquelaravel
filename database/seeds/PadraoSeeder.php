<?php

use Illuminate\Database\Seeder;
use App\Marca;
use App\Estoque_disponivel;
use App\Medida;
use App\Doador;

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
        $marca->marca = "Sem marca";
        $marca->save();

        //default estoque
        $estoque = new Estoque_disponivel();
        $estoque->estoque = "Sem estoque";
        $estoque->save();

        //default medida
        $medida = new Medida();
        $medida->medida = "Sem medida";
        $medida->save();

        //default doador
        $doador = new Doador();
        $doador->nome = "Sem doador";
        $doador->email = "Sem doador";
        $doador->tipo = "Sem doador";
        $doador->save();

        $doador1 = new Doador();
        $doador1->nome = "Doador anônimo";
        $doador1->email = "Doador anônimo";
        $doador1->tipo = "Doador anônimo";
        $doador1->save();

        $doador2 = new Doador();
        $doador2->nome = "Recursos própios";
        $doador2->email = "Recursos própios";
        $doador2->tipo = "Recursos própios";
        $doador2->save();
    }
}
