<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refeicao extends Model
{
   protected $fillable = [
    	'refericao', 'desperdicio', 'quantidade'
    ];
}
