<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Produto;
use App\Doador;
use App\Medida;
use App\Relatorio;
use DB;
use Auth;

class verificar_produtos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:produtos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para verificar o estado dos produtos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        

    }
}
