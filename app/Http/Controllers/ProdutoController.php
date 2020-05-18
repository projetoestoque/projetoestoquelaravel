<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Produto;
use App\produto_em_estoque;
use App\Estoque_disponivel;
use App\Medida;
use App\Doador;
use DB;

class ProdutoController extends Controller
{
    public function listar_produtos() 
    {
        $produtos_estoque=[];
        $produtos_cadastrados=DB::table('produtos')->get();

        $produtos_em_estoque=DB::table('produto_em_estoques')->get();
        $estoques_disponiveis=DB::table('estoque_disponivels')->get();

        foreach($produtos_em_estoque as $produto_em_estoque){
            $produto_cadastrado=Produto::find($produto_em_estoque->Id_produto);
            $produto_cadastrado->id = $produto_em_estoque->id;
            $produto_cadastrado->estoque=Estoque_disponivel::find($produto_em_estoque->Id_estoque);
            $produto_cadastrado->medida=Medida::find($produto_em_estoque->Id_medida)->medida;
            if(Doador::find($produto_em_estoque->Id_doador)->tipo=="fisico"){
                $produto_cadastrado->doador=Doador::find($produto_em_estoque->Id_doador)->nome;
            }
            else{
                $produto_cadastrado->doador=Doador::find($produto_em_estoque->Id_doador)->instituicao;
            }
            $produto_cadastrado->quantidade=$produto_em_estoque->quantidade;
            $produto_cadastrado->vencimento=$produto_em_estoque->vencimento;
            array_push($produtos_estoque,$produto_cadastrado);
        };
        //$produtos_estoque=$this->paginate($produtos_estoque);
        return view('listagem', compact('produtos_estoque', 'produtos_cadastrados'));
    }
   // public function paginate($items, $perPage = 5, $page = null, $options = [])
   // {
   //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
   //     $items = $items instanceof Collection ? $items : Collection::make($items);
   //     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
   // }

    public function deletarProduto()
	{   
        $produto_id = $_GET['id'];
        $produto = Produto::find($produto_id);
        
        $produtos_em_estoque = DB::table('produto_em_estoques')->get();

        foreach($produtos_em_estoque as $produtos) {
            if($produtos->Id_produto == $produto_id) {
                return redirect()->back()
				->withErrors(["errors" => ["Produto em estoque, impossivel deletar!"]]);
            }
        }

        $produto->delete();
        return redirect()->back()->with('status', 'Produto deletado com sucesso!');
    }

    public function deletarEntrada()
	{   
        
        $produto_id = $_GET['id'];
        $produto = Produto_em_estoque::find($produto_id);

        $produto->delete();
        return redirect()->back()->with('status', 'Entrada deletada com sucesso!');
    }
    
    public function entradaAtualizar(Request $req) 
    {
        $data = $req->all();
        if (strpos($req->get('vencimento'), ',') !== false) {
            $data['vencimento'] = date('d/m/Y', strtotime($data['vencimento']));
        }

        $produto = Produto_em_estoque::findOrFail($data['id']);
        $produto->Id_estoque = $data['Id_estoque'];
        $produto->Id_produto = $data['Id_produto'];
        $produto->Id_medida = $data['Id_medida'];
        $produto->Id_doador = $data['Id_doador'];
        $produto->quantidade = $data['quantidade'];
        $produto->vencimento = $data['vencimento'];
        $produto->save();

        return redirect()->route('produtos.listar')->with('status', 'Entrada atualizado com sucesso!');

    }

    public function produtoAtualizar(Request $req) {
        $data = $req->all();
        $produto = Produto::find($data['id']);
        $produto->nome = $data['nome'];
        $produto->tipo = $data['tipo'];
        $produto->codigo_barra = $data['codigo_barra'];
        $produto->marca = $data['marca'];
        $produto->save();

        return redirect()->route('produtos.listar')->with('status', 'Produto atualizado com sucesso!');

    }
}
