<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Doador;
use App\Marca;
use App\Tipo;
use App\Medida;
use DB;

class CadastroController extends Controller
{
    public function produto()
    {
        $medidas=DB::table('medidas')->get();
        $tipos=DB::table('tipos')->get();
        $marcas=DB::table('marcas')->get();
        $doadores=DB::table('doadors')->get();
    	return view('produto',compact('medidas','tipos','marcas','doadores'));
    }

    public function cadastrarProduto(Request $req)
    {
        $dados = $req->all();
            Produto::create($dados);
        
        
        // $produto = new Produto;
        // $produto->nome = $dados['nome'];
        // $produto->vencimento = $dados['vencimento'];
        // $produto->quantidade = $dados['quantidade'];
        // $produto->medidade = $dados['medida'];
        // $produto->codigo_barra = $dados['codigo_barra'];
        // $produto->tipo = $dados['tipo'];
        // $produto->marca = $dados['marca'];
        // $produto->doador = $dados['doador'];

        
        

        //$produto->save();

    	return redirect()->route('produto');
    }

    public function doador()
    {
    	return view('doador');
    }

    public function cadastrarDoador(Request $req)
    {
    	Doador::create($req->all());

    	return redirect()->route('doador');
    }

    public function marca () {
        return view('admin.marca');
    }

    public function tipo () {
        return view('admin.tipo');
    }

    public function medida () {
        return view('admin.medida');
    }

    public function cadastrarMarca (Request $req) {
        Marca::create($req->all());
        return redirect()->route('admin.cadastros');
    }

     public function cadastrarTipo (Request $req) {
        Tipo::create($req->all());
        return redirect()->route('admin.cadastros');
    }

    public function cadastrarMedida (Request $req) {
        Medida::create($req->all());
        return redirect()->route('admin.cadastros');
    }
    public function Cadastros(){
        return view('admin/adminCadastros');
      }
    public function CadastrosSupervisor(){
    return view('cadastros');
    }
}
