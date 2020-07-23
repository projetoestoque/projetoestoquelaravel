<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Relatorio;

class teste extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teste:testar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $relatorio = new Relatorio();
        $relatorio->tipo = "saida";
        $relatorio->data = date('Y-m-d');
        $relatorio->relatorio = "testeasdasd";
        $relatorio->Id_produto = 1;
        $relatorio->Id_entrada = 1;
        $relatorio->Id_doador = 1;
        $relatorio->save();
        echo $relatorio;
    }
}
