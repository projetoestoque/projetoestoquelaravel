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
    	     return redirect()->route('produto');
    }

    public function doador()
    {
    	return view('doador');
    }

    public function cadastrarDoador(Request $req)
    {
	   $cnpj = $req->get("cnpj");
	   $cpf = $req->get("cpf");
	    function validar_cnpj($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
    // Valida tamanho
	if (strlen($cnpj) != 14)		return false;
	// Verifica se todos os digitos são iguais
	if (preg_match('/(\d)\1{13}/', $cnpj))		return false;
	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)	{
	    $soma += $cnpj[$i] * $j;
	    $j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))		return false;
	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)	{
	    $soma += $cnpj[$i] * $j;
	    $j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

	 function validar_cpf($cpf) {
	// Extrai somente os números
	$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
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

	    if(validar_cpf($cnpj)) {
		    Doador::create($req->all());
		} else {
			return redirect()->route("doador")
			->withErrors(['errors' => ['CNPJ INFORMADO NÃO EXISTE']])
			->withInput($req->input());
		}

		if(validar_cpf($cpf)) {
		    Doador::create($req->all());
		} else {
			return redirect()->route("doador")
			->withErrors(['errors' => ['CPF INFORMADO NÃO EXISTE']])
			->withInput($req->input());
		}


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
        $marca = new Marca();
				$marca->marca = strtolower($req->get('marca'));

				if(DB::table('marcas')->where('marca', $marca->marca)->exists())
				{
					return redirect()->route('admin.cadastros');
					->withErrors(["errors"=>["Marca já cadastrada"]]);
				}
				$marca->save();
				return redirect()->route('admin.cadastros');
    }

     public function cadastrarTipo (Request $req) {
			 $tipo = new Tipo();
			 $tipo->tipo = strtolower($req->get('tipo'));

			 if(DB::table('tipos')->where('tipo', $tipo->tipo)->exists())
			 {
				 return redirect()->route('admin.cadastros');
				 ->withErrors(["errors"=>["Tipo já cadastrado"]]);
			 }
			 $tipo->save();
			 return redirect()->route('admin.cadastros');
    }

    public function cadastrarMedida (Request $req) {
				$medida = new Medida();
				$medida->medida = strtolower($req->get('medida'));

				if(DB::table('medidas')->where('medida', $medida->medida)->exists())
				{
					return redirect()->route('admin.cadastros');
					->withErrors(["errors"=>["Medida já cadastrada"]]);
				}
				$medida->save();
				return redirect()->route('admin.cadastros');
    }

			public function cadastrarRefeicao (Request $req){
				Refeicao::create($req->all());
				return redirect()->route('admin.cadastros');
			}
    public function Cadastros(){
        return view('admin/adminCadastros');
      }
    public function CadastrosSupervisor(){
    return view('cadastros');
    }
}
