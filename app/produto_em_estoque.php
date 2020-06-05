<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto_em_estoque extends Model
{
    protected $fillable = [
    	 'quantidade', 'quantidade_minima', 'vencimento', 'Id_estoque', 'Id_produto', 'Id_medida', 'Id_doador'
    ];
}
