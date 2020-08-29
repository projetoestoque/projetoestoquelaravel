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
              'nome_ficticio' => 'Nome teste',
              'razao_social' => "Razão teste",
              'cnpj' => "cnpj teste",
              'telefones' => json_encode(["teste1", "teste2", "teste3"]),
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
