<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doador extends Model
{
     protected $fillable = [
    	'nome', 'E-mail', 'cpf', 'cnpj', 'telefone', 'instituicao'
    ];
}
