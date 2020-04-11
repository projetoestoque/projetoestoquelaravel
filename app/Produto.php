<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
    	'nome', 'vencimento', 'quantidade', 'medidade', 'codigo_barra', 'tipo', 'marca', 'doador'
    ];

    protected $table = 'Produto';
    
}
