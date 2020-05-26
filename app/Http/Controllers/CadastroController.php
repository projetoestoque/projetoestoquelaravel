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

		if(isset($_GET['id'])) {
			$produto = Produto::findOrFail($_GET['id']);
			return view('produto', compact('produto','medidas', 'tipos', 'marcas', 'estoques'));
		}

		return view('produto', compact('medidas', 'tipos', 'marcas', 'estoques'));
	}

	public function cadastrarProduto(Request $req)
	{
		$dados = $req->all();
		Produto::create($dados);
		return redirect()->route('produto')->with('status', 'Produto cadastrado com sucesso!');
	}

	public function doador()
	{
		if(isset($_GET['id'])) {
			$doador_id = $_GET['id'];
			$doador = Doador::find($doador_id);
			return view('doador', compact('doador'));
		}
		return view('doador');
	}

	public function doadorFisico(Request $req)
	{
		$cpf = $req->get("cpf");
		$cpf = preg_replace('/[^0-9]/is', '', $cpf);

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

		if(DB::table('doadors')->where('cpf', $cpf)->exists()) {
			return redirect()->route("doador")
				->withErrors(['errors' => ['CPF INFORMADO JÁ CADASTRADO!']])
				->withInput($req->input());
		}

		if (validar_cpf($cpf)) {
			$doador = new Doador();
			$doador->nome = $req->get('nome');
			$doador->cpf = $req->get('cpf');
			$doador->telefone = $req->get('telefone_fisico');
			$doador->email = $req->get('email_fisico');
			$doador->tipo = $req->get('tipo');
			$doador->save();
		} else {
			return redirect()->route("doador")
				->withErrors(['errors' => ['CPF INFORMADO NÃO EXISTE!']])
				->withInput($req->input());
		}

		return redirect()->route('doador')->with('status', 'Doador cadastrado com sucesso!');;
	}

	public function doadorJuridico(Request $req)
	{
		$cnpj = $req->get("cnpj");
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

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

		if(DB::table('doadors')->where('cnpj', $cnpj)->exists()){
			return redirect()->route('doador')
				->withErrors(['errors' => ['CNPJ INFORMADO JÁ CADASTRADO!']])
				->withInput($req->input());
		}

		if (validar_cnpj($cnpj)) {
			$doador = new Doador();
			$doador->instituicao = $req->get('instituicao');
			$doador->cnpj = $cnpj;
			$doador->telefone = $req->get('telefone_juridico');
			$doador->email = $req->get('email_juridico');
			$doador->tipo = $req->get('tipo');
			$doador->save();
		} else {
			return redirect()->route('doador')
				->withErrors(['errors' => ['CNPJ INFORMADO NÃO EXISTE']])
				->withInput($req->input());
		}

		return redirect()->route('doador')->with('status', 'Doador cadastrado com sucesso!');;
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
		return view('refeicao');
	}
	public function entradaProduto(Request $request)
	{
		$produtos = DB::table('produtos')->get();
		$estoques = DB::table('estoque_disponivels')->get();
		$medidas = DB::table('medidas')->get();
		$doadores = DB::table('doadors')->get();

		if(isset($_GET['id'])) {
			$produto_em_estoque = Produto_em_estoque::find($_GET['id']);
			$produto_em_estoque->marca = Marca::find($produto_em_estoque->Id_produto)->marca;
			$produto_em_estoque->nome = Produto::find($produto_em_estoque->Id_produto)->nome;
			$produto_em_estoque->estoque = Estoque_disponivel::find($produto_em_estoque->Id_estoque);
			$produto_em_estoque->medida = Medida::find($produto_em_estoque->Id_medida);
			$produto_em_estoque->doador = Doador::find($produto_em_estoque->Id_doador);
			return view('entradaProduto', compact('produto_em_estoque','estoques', 'medidas', 'doadores', 'produtos'));
		}
		return view('entradaProduto', compact('estoques', 'medidas', 'doadores', 'produtos'));
	}

	public function entradaProdutoPost(Request $req)
	{
		$produto = new Produto_em_estoque();
		$produto->Id_produto = $req->get('Id_produto');
		$produto->Id_estoque = $req->get('Id_estoque');
		$produto->Id_medida = $req->get('Id_medida');
		$produto->Id_doador = $req->get('Id_doador');
		$produto->quantidade = $req->get('quantidade');
		$produto->vencimento = $req->get('vencimento');
		$produto->save();
		
		return redirect()->back()->with('status', 'Entrada realizada com sucesso!');
	}

	public function cadastrarMarca(Request $req)
	{
		$marca = new Marca();
		$marca->marca = $req->get('marca');

		if (DB::table('marcas')->where('marca', $marca->marca)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Marca já cadastrada"]]);
		}
		$marca->save();
		return redirect()->back()->with('status', 'Marca cadastrada com sucesso!');
	}

	public function marcaAtualizar()
	{
		$novaMarca = $_GET['marca'];
		$marca = new Marca();
		$marca->marca = $novaMarca;

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
		$tipo->tipo = $novoTipo;

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
		$medida->medida = $novaMedida;

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
		$estoque->estoque = $novoEstoque;

		if (DB::table('estoque_disponivels')->where('estoque', $estoque->estoque)->exists()) {
			return false;
		}

		$estoque->save();
		return $estoque;
	}

	public function cadastrarTipo(Request $req)
	{
		$tipo = new Tipo();
		$tipo->tipo = $req->get('tipo');

		if (DB::table('tipos')->where('tipo', $tipo->tipo)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Tipo já cadastrado"]]);
		}
		$tipo->save();
		return redirect()->back()->with('status', 'Tipo cadastrado com sucesso!');
	}

	public function cadastrarMedida(Request $req)
	{
		$medida = new Medida();
		$medida->medida = $req->get('medida');
		$medida->abreviacao = $req->get('abreviacao');

		if (DB::table('medidas')->where('medida', $medida->medida)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Medida já cadastrada"]]);
		}

		$medida->save();
		return redirect()->back()->with('status', 'Medida cadastrada com sucesso!');
	}

	public function cadastrarRefeicao(Request $req)
	{
		Refeicao::create($req->all());
		return redirect()->back()->with('status', 'Refeião registrada com sucesso!');
	}
	public function cadastrarEstoque(Request $req)
	{
		$estoque = new Estoque_disponivel();
		$estoque->estoque = $req->get('estoque');

		if (DB::table('estoque_disponivels')->where('estoque', $estoque->estoque)->exists()) {
			return redirect()->route('admin.cadastros')
				->withErrors(["errors" => ["Estoque já cadastrado"]]);
		}

		$estoque->save();
		return redirect()->back()->with('status', 'Estoque cadastrado com sucesso!');
	}

	public function Cadastros()
	{
		if(isset($_GET['marca_id'])) {
			$marca_id = $_GET['marca_id'];
			$marca = Marca::findOrFail($marca_id);
			return view('admin/adminCadastros', compact('marca'));
		}

		if(isset($_GET['medida_id'])) {
			$medida_id = $_GET['medida_id'];
			$medida = Medida::findOrFail($medida_id);
			return view('admin/adminCadastros', compact('medida'));
		}

		if(isset($_GET['tipo_id'])) {
			$tipo_id = $_GET['tipo_id'];
			$tipo = Tipo::findOrFail($tipo_id);
			return view('admin/adminCadastros', compact('tipo'));
		}

		if(isset($_GET['estoque_id'])) {
			$estoque_id = $_GET['estoque_id'];
			$estoque = Estoque_disponivel::findOrFail($estoque_id);
			return view('admin/adminCadastros', compact('estoque'));
		}

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
}
