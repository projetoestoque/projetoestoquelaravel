<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doador_juridico extends Model
{
   protected $fillable = [
    	'instituicao',  'cnpj', 'telefone', 'e-mail', 'endereco'
    ];
}
