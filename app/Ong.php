<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ong extends Model
{
    protected $fillable = [
    	'nome', 'cnpj', 'telefone', 'endereco'
    ];
}
