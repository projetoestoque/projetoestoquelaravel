<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class RegistrarController extends Controller
{
    public function registrar(Request $req) {
        if(DB::table('users')->where('name', $req->get('name'))->exists()) {
            return redirect()->back()->withErrors(['errors' => ['Nome de usuário já existe!']]);
        } else {
            User::create([
                'name' => $req->get('name'),
                'password' => bcrypt($req->get('password')),
                'is_admin' => $req->get('is_admin')
            ]);
            
            return redirect()->back()->with('status', 'Usuário cadastrado com sucesso!');
        }
        
    }
}
