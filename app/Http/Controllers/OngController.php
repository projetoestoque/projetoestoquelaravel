<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ong;
use App\Endereco;
use DB;

class OngController extends Controller
{
    public function ongPost(Request $req) 
    {
        $ong = Ong::findOrFail(1);
        
        if($req->photo == null) {
            $file = $req->photo1;
        } else {
            $file = $req->photo;
        }

        if($file->isValid()) {
            $extensao = $file->extension();
            $nome = "ong_logo";
            $nomeArquivo = "$nome.$extensao";

            $upload = $file->storeAs('ong', $nomeArquivo);

            if(!$upload) {
                return redirect()
                    ->back()
                    ->with('errors', ['Falha ao fazer upload!']);
            }
            
            $ong->imagem = $nomeArquivo;
            $ong->cor = $req->get('cor');
            $ong->save();

            return redirect()->back()->with('status', 'Ong atualizada com sucesso');
        }

        
    }

    public function infoPost(Request $req)
    {

        $ong = Ong::findOrFail(1);
        $ong->telefones = json_encode($req->get('telefone'));
        $ong->email = $req->get('email_ong');
        $ong->save();

        $endereco = Endereco::findOrFail(1);
        $endereco->cidade = $req->get('cidade_ong');
        $endereco->uf = $req->get('estado_ong');
        $endereco->logradouro = $req->get('rua_ong');
        $endereco->cep = $req->get('cep_ong');
        $endereco->save();


        return redirect()->back()->with('status', 'Ong atualizada com sucesso');
    }
}
