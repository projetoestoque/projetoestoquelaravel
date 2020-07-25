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
use App\Endereco;
use App\Relatorio;
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
			$endereco = null;

			if($doador->Id_endereco != null) {
				$endereco = Endereco::find($doador->Id_endereco);
			}

			return view('doador', compact('doador','endereco'));
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

		if (validar_cpf($cpf)) {
			if(DB::table('doadors')->where('cpf', $cpf)->exists()) {
				return redirect()->route("doador")
					->withErrors(['errors' => ['CPF INFORMADO JÁ CADASTRADO!']])
					->withInput($req->input());
			}

			$doador = new Doador();
			$doador->nome = $req->get('nome');
			$doador->cpf = $cpf;
			$doador->telefone = $req->get('telefone_fisico');
			$doador->email = $req->get('email_fisico');
			$doador->tipo = $req->get('tipo');

			if($req->get('cidade') != "") {
				$endereco = new Endereco();
				$endereco->cep = $req->get('cep');
				$endereco->cidade = $req->get('cidade');
				$endereco->logradouro = $req->get('numero');
				$endereco->bairro = $req->get('bairro');
				$endereco->numero = $req->get('numero');
				$endereco->save();
				$doador->Id_endereco = $endereco->id;
			}
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
			$produto_em_estoque->marca = Produto::find($produto_em_estoque->Id_produto)->marca;
			$produto_em_estoque->nome = Produto::find($produto_em_estoque->Id_produto)->nome;
			$produto_em_estoque->estoque = Estoque_disponivel::find($produto_em_estoque->Id_estoque);
			$produto_em_estoque->medida = Medida::find($produto_em_estoque->Id_medida);
			$produto_em_estoque->doador = Doador::find($produto_em_estoque->Id_doador);
			return view('entradaProduto', compact('produto_em_estoque','estoques', 'medidas', 'doadores', 'produtos'));
		}
		
		if(isset($_GET['produto']) && isset($_GET['doador'])) {
			$get_id = $_GET['produto'];
			$produto = Produto::findOrFail($get_id);
			$get_id = $_GET['doador'];
			$doador = Doador::findOrFail($get_id);
			return view('entradaProduto', compact('estoques', 'medidas', 'doadores', 'produtos', 'produto', 'doador'));
		} else if(isset($_GET['doador'])) {
			$get_id = $_GET['doador'];
			$doador = Doador::findOrFail($get_id);
			return view('entradaProduto', compact('estoques', 'medidas', 'doadores', 'produtos', 'doador'));
		} else if(isset($_GET['produto'])) {
			$get_id = $_GET['produto'];
			$produto = Produto::findOrFail($get_id);
			return view('entradaProduto', compact('estoques', 'medidas', 'doadores', 'produtos', 'produto'));
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
		$produto->quantidade_minima = $req->get('quantidade_minima');
		$produto->vencimento = $req->get('vencimento');
		$produto->save();

		$relatorio = new Relatorio();
		$relatorio->Id_produto = $produto->Id_produto;
		$relatorio->Id_doador = $produto->Id_doador;
		$relatorio->Id_entrada = $produto->id;
		$relatorio->tipo = "entrada";
		$relatorio->relatorio = "Entrada de ". $produto->quantidade . " " .$produto->medida ." de ". Produto::find($produto->Id_produto)->nome . " " .Produto::find($produto->Id_produto)->marca ." em ". date('d/m/Y') ." doado pelo/a ". (Doador::find($produto->Id_doador)->nome == null?Doador::find($produto->Id_doador)->instituicao:Doador::find($produto->Id_doador)->nome) ." de cpf/cpnj " . (Doador::find($produto->Id_doador)->nome == null?Doador::find($produto->Id_doador)->cnpj:Doador::find($produto->Id_doador)->cpf). "com vencimento em ". $produto->vencimento;
		$relatorio->data = date("Y-m-d");
		$relatorio->save();

		return redirect()->route('entradaProduto')->with('status', 'Entrada realizada com sucesso!');
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
	public function menuCadastros(){
		return view('admin/adminMenuCadastros');
	}
	public function listarCadastros($reference="Produto")
    {
		$marca_antiga = null;
		$medida_antiga = null;
		$tipo_antigo = null;
		$estoque_antigo = null;

		if(isset($_GET['marca_id'])) {
			$marca_id = $_GET['marca_id'];
			$marca_antiga = Marca::findOrFail($marca_id);
		}

		if(isset($_GET['medida_id'])) {
			$medida_id = $_GET['medida_id'];
			$medida_antiga = Medida::findOrFail($medida_id);
		}

		if(isset($_GET['tipo_id'])) {
			$tipo_id = $_GET['tipo_id'];
			$tipo_antigo = Tipo::findOrFail($tipo_id);
		}

		if(isset($_GET['estoque_id'])) {
			$estoque_id = $_GET['estoque_id'];
			$estoque_antigo = Estoque_disponivel::findOrFail($estoque_id);
		}

		$all = [];
		$doadores = [];
        $produtos_cadastrados = DB::table('produtos')->orderBy('nome')->get();
        $doadores_fisicos = DB::table('doadors')->where('nome', '!=', '')->orderBy('nome')->get();
		$doadores_juridicos = DB::table('doadors')->where('instituicao', '!=', '')->orderBy('nome')->get();
		foreach($doadores_fisicos as $doador) {
			array_push($doadores, $doador);
		}
		foreach($doadores_juridicos as $doador) {
			array_push($doadores, $doador);
		}
        $tipos = DB::table('tipos')->orderBy('tipo')->get();
        $medidas = DB::table('medidas')->orderBy('medida')->get();
        $marcas = DB::table('marcas')->orderBy('marca')->get();
		$estoques_disponiveis = DB::table('estoque_disponivels')->orderBy('estoque')->get();

		//listar todos
		foreach($produtos_cadastrados as $produto) {
			array_push($all, [
				'nome' => $produto->nome,
				'tipo' => "produto/$produto->tipo"
			]);
		}

		foreach($doadores as $doador) {
			if($doador->tipo == 'fisico') {
				array_push($all, [
					'nome' => $doador->nome,
					'tipo' => "doador $doador->tipo"
				]);
			} else if($doador->tipo == 'juridico'){
				array_push($all, [
					'nome' => $doador->instituicao,
					'tipo' => "doador $doador->tipo"
				]);
			}
		}

		foreach($tipos as $tipo) {
			array_push($all, [
				'nome' => $tipo->tipo,
				'tipo' => 'tipo'
			]);
		}

		foreach($medidas as $medida) {
			array_push($all, [
				'nome' => $medida->medida,
				'tipo' => 'medida'
			]);
		}

		foreach($marcas as $marca) {
			array_push($all, [
				'nome' => $marca->marca,
				'tipo' => 'marca'
			]);
		}

		foreach($estoques_disponiveis as $estoque_disponivel) {
			array_push($all, [
				'nome' => $estoque_disponivel->estoque,
				'tipo' => 'estoque'
			]);
		}
	
        return view('admin/visualizarCadastros', compact('all','produtos_cadastrados','tipos','medidas','marcas','estoques_disponiveis','doadores','marca_antiga','medida_antiga','tipo_antigo','estoque_antigo'));
	}
	
	public function pesquisarCadastros()
  	{
		$produtos_em_estoque = DB::table('produto_em_estoques')->get();
		$items = [];
		$query = "";
		if(isset($_GET['query'])) $query = $_GET['query'];
		if(!$query) return false;

		//filtrar produtos cadastrados
		$produtos_cadastrados_filtrados = Produto::where('nome', 'LIKE', $query.'%')->get();
		foreach($produtos_cadastrados_filtrados as $produto) {
			if($produto->nome[0] == $query[0]) {
				$produto->tipo = "Produto";
				array_push($items, $produto);
			}
		}
		
		//filtrar doadores
		$doadores_fisicos_filtrados = Doador::where('nome', 'LIKE', $query.'%')->get();
		$doadores_juridicos_filtrados = Doador::where('instituicao', 'LIKE', '%'.$query.'%')->get();
		foreach($doadores_fisicos_filtrados as $doador) {
			if($query[0] == $doador->nome[0]) {
				array_push($items, $doador);
			}
		}
		foreach($doadores_juridicos_filtrados as $doador) {
			if($query[0] == $doador->instituicao[0]) {
				array_push($items, $doador);
			}
		}

		//filtrar tipos
		$tipos_filtrados = Tipo::where('tipo', 'LIKE', $query.'%')->get();
		foreach($tipos_filtrados as $tipo) {
			if($query[0] == $tipo->tipo[0]) {
				$tipo->nome = $tipo->tipo;
				$tipo->tipo = "Tipo";
				array_push($items, $tipo);
			}
		}

		//filtrar medidas
		$medidas_filtradas = Medida::where('medida', 'LIKE', $query.'%')->get();
		foreach($medidas_filtradas as $medida) {
			if($query[0] == $medida->medida[0]) {
				$medida->nome = $medida->medida;
				$medida->tipo = "Medida";
				array_push($items, $medida);
			}
		}

		//filtrar marcas
		$marcas_filtradas = Marca::where('marca', 'LIKE', $query.'%')->get();
		foreach($marcas_filtradas as $marca) {
			if($query[0] == $marca->marca[0]) {
				$marca->nome = $marca->marca;
				$marca->tipo = "Marca";
				array_push($items, $marca);
			}
		}

		//filtrar estoques
		$estoques_filtrados = Estoque_disponivel::where('estoque', 'LIKE', $query.'%')->get();
		foreach($estoques_filtrados as $estoque) {
			// if($query[0] == $estoque->estoque[0]) {
				
			// }

			$estoque->nome = $estoque->estoque;
				$estoque->tipo = "Estoque";
				array_push($items, $estoque);
		}
		
		
		return $items;
  }

  public function pesquisarCodigoBarra() {
	$items = [];
	$query = "";
	if(isset($_GET['query'])) $query = $_GET['query'];
	if(!$query) return false;

	$produtos_filtrados = Produto::where('codigo_barra', 'LIKE', $query.'%')->get();
	foreach($produtos_filtrados as $produto) {
		array_push($items, $produto);
	}
	
	return $items;
  }

}
