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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Id_estoque');
            $table->unsignedBigInteger('Id_produto');
            $table->unsignedBigInteger('Id_relatorio');
            $table->unsignedBigInteger('Id_nota_fiscal');
            $table->unsignedBigInteger('Id_doador');
            $table->string('nome');
            $table->string('usuario')->unique();
            $table->timestamp('Usuario_verified_at')->nullable();
            $table->string('senha');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('Id_estoque')->references('id')->on('estoques');
            $table->foreign('Id_produto')->references('id')->on('produtos');
            $table->foreign('Id_relatorio')->references('id')->on('relatorios');
           $table->foreign('Id_nota_fiscal')->references('id')->on('nota_fiscals');
            $table->foreign('Id_doador')->references('id')->on('doadors');
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

