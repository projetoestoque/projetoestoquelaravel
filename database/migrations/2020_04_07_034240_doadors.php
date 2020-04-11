<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Doadors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Doador', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('Id_produto');
            $table->string('Nome');
            $table->string('E-mail');
            $table->string('CPF');
            $table->string('CNPJ');
            $table->string('Telefone');
            $table->string('Instituicao');
            $table->timestamps();

            $table->foreign('Id_produto')-> references('Id')->on('Produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doadors');
    }
}
