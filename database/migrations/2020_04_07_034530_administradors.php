<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Administradors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Administrador', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('Id_estoque');
            $table->unsignedBigInteger('Id_produto');
            $table->unsignedBigInteger('Id_relatorio');
            $table->unsignedBigInteger('Id_nota_fiscal');
            $table->unsignedBigInteger('Id_supervisor');
            $table->unsignedBigInteger('Id_doador');
            $table->unsignedBigInteger('Id_medida');
            $table->unsignedBigInteger('Id_tipo');
            $table->unsignedBigInteger('Id_marca');
            $table->string('Nome');
            $table->string('Usuario')->unique();
            $table->timestamp('Usuario_verified_at')->nullable();
            $table->string('Senha');
            $table->rememberToken();

            $table->foreign('Id_estoque')->references('Id')->on('Estoque');
            $table->foreign('Id_produto')->references('Id')->on('Produto');
            $table->foreign('Id_relatorio')->references('Id')->on('Relatorio');
            $table->foreign('Id_nota_fiscal')->references('Id')->on('Nota_fiscal');
            $table->foreign('Id_supervisor')->references('Id')->on('Supervisor');
            $table->foreign('Id_doador')->references('Id')->on('Doador');
            $table->foreign('Id_medida')->references('Id')->on('Medida');
            $table->foreign('Id_tipo')->references('Id')->on('Tipo');
            $table->foreign('Id_marca')->references('Id')->on('Marca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Administrador');
    }
}
