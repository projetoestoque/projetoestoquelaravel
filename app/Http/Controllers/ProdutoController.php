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
use App\Marca;
use DB;

class ProdutoController extends Controller
{

    public function listar_produtos() 
    {
        $produtos_cadastrados = DB::table('produtos')->get();
        $produtos_em_estoque = DB::table('produto_em_estoques')->get();

        $produtos_estoque = [];
        $produtos_acima = [];
        $produtos_abaixo = [];
        $produtos_sem = [];

        foreach($produtos_em_estoque as $produto) {
            //listando todo os produtos em estoque
            $produto_estoque = $produto;
            $produto_estoque->nome = Produto::findOrFail($produto->Id_produto)->nome;
            $produto_estoque->estoque = Estoque_disponivel::findOrFail($produto->Id_estoque);
            $produto_estoque->marca = Produto::findOrFail($produto->Id_produto)->marca;
            $produto_estoque->abreviacao = Medida::findOrFail($produto->Id_medida)->abreviacao;
            array_push($produtos_estoque, $produto_estoque);

            //listando produtos acima do nivel critico
            if($produto->quantidade >= 5) {
                $produto_acima = $produto;
                $produto_acima->nome = Produto::findOrFail($produto->Id_produto)->nome;
                $produto_acima->estoque = Estoque_disponivel::findOrFail($produto->Id_estoque);
                $produto_acima->marca = Produto::findOrFail($produto->Id_produto)->marca;
                $produto_acima->abreviacao = Medida::findOrFail($produto->Id_medida)->abreviacao;
                array_push($produtos_acima, $produto_acima);
            }

            //listando produtos abaixo do nivel critico
            if($produto->quantidade < 5) {
                $produto_abaixo = $produto;
                $produto_abaixo->nome = Produto::findOrFail($produto->Id_produto)->nome;
                $produto_abaixo->estoque = Estoque_disponivel::findOrFail($produto->Id_estoque);
                $produto_abaixo->marca = Produto::findOrFail($produto->Id_produto)->marca;
                $produto_abaixo->abreviacao = Medida::findOrFail($produto->Id_medida)->abreviacao;
                array_push($produtos_abaixo, $produto_abaixo);
            }
        }

        foreach($produtos_cadastrados as $produto) {
            if((DB::table('produto_em_estoques')->where('Id_produto', $produto->id)->exists()) == false){
                array_push($produtos_sem, $produto);
            }
        }
        
        return view('listagem', compact('produtos_estoque','produtos_acima', 'produtos_abaixo', 'produtos_sem'));
        //$produtos_estoque=$this->paginate($produtos_estoque);
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

        if($produto->quantidade > 0) {
            return redirect()->back()->with('status', 'Entrada em estoque, impossivel deletar!');
        }

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
