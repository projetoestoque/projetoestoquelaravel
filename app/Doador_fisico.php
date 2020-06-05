<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doador_fisico extends Model
{
    protected $fillable = [
    	'nome',  'cpf', 'telefone', 'e-mail', 'endereco'
    ];
}
