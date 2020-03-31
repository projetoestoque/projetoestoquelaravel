<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

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

}
