<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados=[
            'name'=>"admin",
            'email'=>"admin@mail.com",
            'password'=>bcrypt("admin"),
        ];
        User::create($dados);
        echo "Usuário Criado";
    }
}
