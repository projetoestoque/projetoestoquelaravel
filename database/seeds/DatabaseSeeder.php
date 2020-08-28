<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(AdministradorSeeder::class);
         $this->call([
             UsuarioSeeder::class,
             TipoSeeder::class,
             DoadorSeeder::class,
             EstoqueSeeder::class,
             MarcaSeeder::class,
             MedidaSeeder::class,
             ProdutoSeeder::class,
             EntradaSeeder::class,
             RelatorioSeeder::class,
             OngSeeder::class
         ]);
    }
}
