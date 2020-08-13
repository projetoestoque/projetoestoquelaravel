<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOngsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ongs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('cnpj')-> nullabe();
            $table->string('telefone');
            $table->unsignedBigInteger('Id_endereco')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('Id_endereco')->references('id')->on('enderecos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ongs');
    }
}
