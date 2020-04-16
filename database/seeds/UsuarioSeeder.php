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
        $user = [

[
'name'=>'admin',
'is_admin'=>'1',
'password'=> bcrypt('admin'),
],

[

'name'=>'supervisor',

'is_admin'=>'0',

'password'=> bcrypt('supervisor'),

],

];

foreach ($user as $key => $value) {

User::create($value);

}


    }
}
