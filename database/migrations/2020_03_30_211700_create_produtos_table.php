<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('Nome');
            $table->string('Vencimento');
            $table->integer('Quantidade');
            $table->string('Medida');
            $table->integer('Codigo_barra');
            $table->string('Tipo');
            $table->string('Marca');
            $table->string('Doador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
