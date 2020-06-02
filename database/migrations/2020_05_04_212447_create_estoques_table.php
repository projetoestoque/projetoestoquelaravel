<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Id_produto');
            $table->unsignedBigInteger('Id_estoque');
            $table->timestamps();

            $table->foreign('Id_produto')->references('id')->on('produtos');
            $table->foreign('Id_estoque')->references('id')->on('estoque_disponivels');
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
        Schema::dropIfExists('estoques');
    }
}
