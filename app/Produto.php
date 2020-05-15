<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
    	'nome', 'codigo_barra', 'tipo', 'marca'
    ];
    
}
