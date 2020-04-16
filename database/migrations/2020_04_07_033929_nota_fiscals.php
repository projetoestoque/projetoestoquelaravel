<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotaFiscals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_fiscals', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('Id_produto');
            $table->string('Foto');
            $table->decimal('Valor');
            $table->timestamps();

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
        Schema::dropIfExists('nota_fiscal');
    }
}
