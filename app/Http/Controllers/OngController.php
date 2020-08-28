<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ong;
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
                    ->with('error', ['Falha ao fazer upload!']);
            }
            
            $ong->imagem = $nomeArquivo;
            $ong->cor = $req->get('cor');
            $ong->save();

            return redirect()->back();
            
            // if($req->photo == null) {
            //     $req->photo1->storeAs('')
            // } else {
            //     $file = $req->photo;
            // }
        }

        
    }
}
