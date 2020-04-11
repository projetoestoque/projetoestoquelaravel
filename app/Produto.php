<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
    	'nome', 'vencimento', 'quantidade', 'medida', 'codigo_barra', 'tipo', 'marca', 'doador'
    ];
    
}
