<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoEmEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_em_estoques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Id_estoque');
            $table->unsignedBigInteger('Id_produto');
            $table->unsignedBigInteger('Id_medida');
            $table->unsignedBigInteger('Id_doador_fisico')->unique();
            $table->unsignedBigInteger('Id_doador_juridico')->unique();
            $table->Integer('quantidade');
            $table->string('vencimento');
            $table->timestamps();

             $table->foreign('Id_estoque')->references('id')->on('estoques');
             $table->foreign('Id_produto')->references('id')->on('produtos');
             $table->foreign('Id_medida')->references('id')->on('medidas');
             $table->foreign('Id_doador_fisico')->references('id')->on('doador_fisicos');
             $table->foreign('Id_doador_juridico')->references('id')->on('doador_juridicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_em_estoques');
    }
}
