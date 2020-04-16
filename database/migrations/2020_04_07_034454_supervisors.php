<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Supervisors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('Id_estoque');
            $table->unsignedBigInteger('Id_produto');
            $table->unsignedBigInteger('Id_relatorio');
            $table->unsignedBigInteger('Id_nota_fiscal');
            $table->unsignedBigInteger('Id_doador');
            $table->string('Nome');
            $table->string('Usuario')->unique();
            $table->timestamp('Usuario_verified_at')->nullable();
            $table->string('Senha');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('Id_estoque')->references('Id')->on('estoques');
            $table->foreign('Id_produto')->references('Id')->on('produtos');
            $table->foreign('Id_relatorio')->references('Id')->on('relatorios');
           $table->foreign('Id_nota_fiscal')->references('Id')->on('nota_fiscals');
            $table->foreign('Id_doador')->references('Id')->on('doadors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisor');
    }
}

