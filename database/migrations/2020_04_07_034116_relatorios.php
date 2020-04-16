<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('Id_estoque');
            $table->unsignedBigInteger('Id_produto');
            $table->string('Diaria');
            $table->string('Semanal');
            $table->string('Mensal');
            $table->string('Anual');
            $table->timestamps();

            $table->foreign('Id_estoque')->references('Id')->on('estoques');
            $table->foreign('Id_produto')->references('Id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorios');
    }
}
