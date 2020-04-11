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
        DB::table('admins')->insert([
            'Nome'=>'Carlos Admin',
            'Usuario'=>'administrador',
            'password'=> Hash::make('administrador123'),
        ]);
        DB::table('supervs')->insert([
            'Nome'=>'Carlos Sup',
            'Usuario'=>'supervisor',
            'password'=> Hash::make('supervisor123'),
        ]);
         //$this->call(AdministradorSeeder::class);
         //$this->call(SupervisorSeeder::class);
    }
}
