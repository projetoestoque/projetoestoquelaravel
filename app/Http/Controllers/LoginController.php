<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function entrar(Request $req){
        $dados=$req->all();
        if(Auth::attempt(['name'=>$dados['name'],'password'=>$dados['password']])){
            return redirect()->route('produto');
        }
        return redirect()->route('login');
    }
    public function sair(){
        Auth::logout();
        return redirect()->route('login');
    }
}
