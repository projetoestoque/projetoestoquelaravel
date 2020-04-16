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
        Schema::create('doadors', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('Nome');
            $table->string('E-mail');
            $table->string('CPF');
            $table->string('CNPJ');
            $table->string('Telefone');
            $table->string('Instituicao');
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
        Schema::dropIfExists('doadors');
    }
}
