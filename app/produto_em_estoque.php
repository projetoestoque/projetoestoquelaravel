<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produto_em_estoque extends Model
{
    protected $fillable = [
    	 'quantidade', 'vencimento'
    ];
}
