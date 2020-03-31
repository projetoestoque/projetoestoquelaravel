<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Doador;

class CadastroController extends Controller
{
    public function produto()
    {
    	return view('produto');
    }

    public function cadastrarProduto(Request $req)
    {
    	$dados=$req->all();
    	Produto::create($dados);

    	return view('/produto');
    }

    public function doador()
    {
    	return view('doador');
    }

    public function cadastrarDoador(Request $req)
    {
    	$dados=$req->all();
    	Doador::create($dados);

    	return view('/doador');
    }

}
