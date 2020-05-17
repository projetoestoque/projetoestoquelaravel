<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Doador;
use App\Marca;
use App\Tipo;
use App\Medida;
use App\Refeicao;
use App\Estoque_disponivel;
use App\Produto_em_estoque;
use DB;

class CadastroController extends Controller
{

	public function produto()
	{
		$medidas = DB::table('medidas')->get();
		$tipos = DB::table('tipos')->get();
		$marcas = DB::table('marcas')->get();
		$estoques = DB::table('estoque_disponivels')->get();
		return view('produto', compact('medidas', 'tipos', 'marcas', 'estoques'));
	}

	public function cadastrarProduto(Request $req)
	{
		$dados = $req->all();
		Produto::create($dados);
		return redirect()->route('produto')->with('message', 'Produto cadastrado com sucesso! ;-)');
	}

	public function doador()
	{
		return view('doador');
	}

	public function doadorFisico(Request $req)
	{
		$cpf = $req->get("cpf");

		function validar_cpf($cpf)
		{
			// Extrai somente os números
			$cpf = preg_replace('/[^0-9]/is', '', $cpf);
			// Verifica se foi informado todos os digitos corretamente
			if (strlen($cpf) != 11) {
				return false;
			}
			// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
			if (preg_match('/(\d)\1{10}/', $cpf)) {
				return false;
			}
			// Faz o calculo para validar o CPF
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf[$c] * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf[$c] != $d) {
					return false;
				}
			}
			return true;
		}

		if (validar_cpf($cpf)) {
			$doador = new Doador();
			$doador->nome = $req->get('nome');
			$doador->cpf = $req->get('cpf');
			$doador->telefone = $req->get('telefone');
			$doador->email = $req->get('e-mail');
			$doador->tipo = $req->get('tipo');
			$doador->save();
		} else {
			return redirect()->route("doador")
				->withErrors(['errors' => ['CPF INFORMADO NÃO EXISTE']])
				->withInput($req->input());
		}
		return redirect()->route('doador');
	}

	public function doadorJuridico(Request $req)
	{
		$cnpj = $req->get("cnpj");
		function validar_cnpj($cnpj)
		{
			$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
			// Valida tamanho
			if (strlen($cnpj) != 14)		return false;
			// Verifica se todos os digitos são iguais
			if (preg_match('/(\d)\1{13}/', $cnpj))		return false;
			// Valida primeiro dígito verificador
			for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
				$soma += $cnpj[$i] * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}
			$resto = $soma % 11;
			if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))		return false;
			// Valida segundo dígito verificador
			for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
				$soma += $cnpj[$i] * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}
			$resto = $soma % 11;
			return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
		}

		if (validar_cnpj($cnpj)) {
			$doador = new Doador();
			$doador->instituicao = $req->get('instituicao');
			$doador->cnpj = $req->get('cnpj');
			$doador->telefone = $req->get('telefone');
			$doador->email = $req->get('e-mail');
			$doador->tipo = $req->get('tipo');
			$doador->save();
		} else {
			return redirect()->route('doador')
				->withErrors(['errors' => ['CNPJ INFORMADO NÃO EXISTE']])
				->withInput($req->input());
		}
		return redirect()->route('doador');
	}

	public function marca()
	{
		return view('admin.marca');
	}

	public function tipo()
	{
		return view('admin.tipo');
	}

	public function medida()
	{
		return view('admin.medida');
	}
	public function refeicao()
	{
		return view('Refeicao');
	}
	public function entradaProduto()
	{
		$produtos = DB::table('produtos')->get();
		$estoques = DB::table('estoque_disponivels')->get();
		$medidas = DB::table('medidas')->get();
		$doadores = DB::table('doadors')->get();
		return view('entradaProduto', compact('estoques', 'medidas', 'doadores', 'produtos'));
	}

	public function entradaProdutoPost(Request $req)
	{
		Produto_em_estoque::create($req->all());
	}

	public function cadastrarMarca(Request $req)
	{
		$marca = new Marca();
		$marca->marca = strtolower($req->get('marca'));

		if (DB::table('marcas')->where('marca', $marca->marca)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Marca já cadastrada"]]);
		}
		$marca->save();
		return redirect()->back();
	}

	public function marcaAtualizar()
	{
		$novaMarca = $_GET['marca'];
		$marca = new Marca();
		$marca->marca = strtolower($novaMarca);

		if (DB::table('marcas')->where('marca', $marca->marca)->exists()) {
			return false;
		}
		$marca->save();
		return $marca;
	}

	public function tipoAtualizar()
	{
		$novoTipo = $_GET['tipo'];
		$tipo = new Tipo();
		$tipo->tipo = strtolower($novoTipo);

		if (DB::table('tipos')->where('tipo', $tipo->tipo)->exists()) {
			return false;
		}
		$tipo->save();
		return $tipo;
	}

	public function medidaAtualizar()
	{
		$novaMedida = $_GET['medida'];
		$medida = new Medida();
		$medida->medida = strtolower($novaMedida);

		if (DB::table('medidas')->where('medida', $medida->medida)->exists()) {
			return false;
		}
		$medida->save();
		return $medida;
	}

	public function estoqueAtualizar()
	{
		$novoEstoque = $_GET['estoque'];
		$estoque = new Estoque_disponivel();
		$estoque->estoque = strtolower($novoEstoque);

		if (DB::table('estoque_disponivels')->where('estoque', $estoque->estoque)->exists()) {
			return false;
		}
		$estoque->save();
		return $estoque;
	}

	public function cadastrarTipo(Request $req)
	{
		$tipo = new Tipo();
		$tipo->tipo = strtolower($req->get('tipo'));

		if (DB::table('tipos')->where('tipo', $tipo->tipo)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Tipo já cadastrado"]]);
		}
		$tipo->save();
		return redirect()->back();
	}

	public function cadastrarMedida(Request $req)
	{
		$medida = new Medida();
		$medida->medida = strtolower($req->get('medida'));

		if (DB::table('medidas')->where('medida', $medida->medida)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Medida já cadastrada"]]);
		}
		$medida->save();
		return redirect()->back();
	}

	public function cadastrarRefeicao(Request $req)
	{
		Refeicao::create($req->all());
		return redirect()->back();
	}
	public function cadastrarEstoque(Request $req)
	{
		$estoque = new Estoque_disponivel();
		$estoque->estoque = strtolower($req->get('estoque'));

		if (DB::table('estoque_disponivels')->where('estoque', $estoque->estoque)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Estoque já cadastrado"]]);
		}
		$estoque->save();
		return redirect()->back();
	}

	public function Cadastros()
	{
		return view('admin/adminCadastros');
	}
	public function CadastrosSupervisor()
	{
		return view('cadastros');
	}
	public function CadastrosInsercoes()
	{
		return view('admin/adminMenuInserirCadastrar');
	}
	public function Insercoes()
	{
		return view('admin/adminInsercoes');
	}
	public function editarProduto($id){
		$produtos = DB::table('produtos')->get();
		$estoques = DB::table('estoque_disponivels')->get();
		$medidas = DB::table('medidas')->get();
		$doadores = DB::table('doadors')->get();
		$registro= produto_em_estoque::find($id);
		return view('admin.editarProduto',compact('registro','produtos','estoques','medidas','doadores','registro'));
		
	}
	public function salvarAlteracoes(Request $req,$id)
	{
		$Produto = produto_em_estoque::find($id);

		foreach ($variable as $key => $value) {
			if ($Produto->$key != $req->$key) {
				$Produto->$key = $req->$key;
			}
		}
		$Produto->save();
	}

	public function deletarAlteracoes(Request $req)
	{
		$Produto = App\Produto::find($id);
		$Produto->delete();
	}
}
