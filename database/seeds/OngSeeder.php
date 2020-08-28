<?php

use Illuminate\Database\Seeder;
use App\Ong;
use App\Endereco;

class OngSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $enderecos = [
            [
              'cep' => "cep teste",
              'cidade' => "cidade teste",
              'uf' => "uf teste",
              'bairro' => "bairro teste",
              'logradouro' => "logradouro teste",
              'numero' => "13"
            ]
          ];

        foreach($enderecos as $endereco => $value){
            Endereco::create($value);
        }

        //////////////////////////////////////

        $ongs = [
            [
              'razao_social' => "Nome teste",
              'cnpj' => "cnpj teste",
              'telefone' => "telefone teste",
              'email' => "email teste",
              'imagem' => "storage/ong/ong_logo.png",
              'Id_endereco' => 1,
              'cor' => 'blue'
            ]
          ];

          foreach($ongs as $ong => $value){
            Ong::create($value);
          }
    }
}
