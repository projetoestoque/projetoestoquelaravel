<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{
    public function listar_produtos() 
    {
        $produtos = DB::table('produto')->get();
        return view('listar_produtos', compact('produtos'));
    }
}
