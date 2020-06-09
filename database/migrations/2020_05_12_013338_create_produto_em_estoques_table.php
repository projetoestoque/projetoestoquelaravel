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
            $table->unsignedBigInteger('Id_doador');
            $table->Integer('quantidade');
            $table->string('vencimento');
            $table->Integer('quantidade_minima');
            $table->timestamps();

             $table->foreign('Id_estoque')->references('id')->on('estoque_disponivels');
             $table->foreign('Id_produto')->references('id')->on('produtos');
             $table->foreign('Id_medida')->references('id')->on('medidas');
             $table->foreign('Id_doador')->references('id')->on('doadors');
             $table->softDeletes();
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
