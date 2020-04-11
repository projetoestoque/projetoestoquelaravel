<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doador extends Model
{
     protected $fillable = [
    	'nome', 'e-mail', 'cpf', 'cnpj', 'telefone', 'instituicao'
    ];
}
