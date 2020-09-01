<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ong;
use App\Endereco;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

   public function adminHome() {
       return view('admin.adminHome');
    }
    public function estoqueMenu(){
        return view('estoqueMenu');
    }
    public function estoqueEntradas(){
        return view('entrada');
    }
    public function profile(){
        $ong = Ong::findOrFail(1);
        $ong->telefones = json_decode($ong->telefones);
        $logo = $ong->imagem;
        $endereco = Endereco::findOrFail($ong->Id_endereco);
        return view('admin.perfil', compact('ong', 'endereco','logo'));
    }
    public function editProfile(){
        $ong = Ong::findOrFail(1);
        $ong->telefones = json_decode($ong->telefones);
        $endereco = Endereco::findOrFail($ong->Id_endereco);
        return view('admin.editarPerfil', compact('ong', 'endereco'));
    }
}
