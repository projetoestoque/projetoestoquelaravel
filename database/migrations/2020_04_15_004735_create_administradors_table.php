<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Id_estoque');
            $table->unsignedBigInteger('Id_produto');
            $table->unsignedBigInteger('Id_relatorio');
            $table->unsignedBigInteger('Id_nota_fiscal');
            $table->unsignedBigInteger('Id_supervisor');
            $table->unsignedBigInteger('Id_doador');
            $table->unsignedBigInteger('Id_medida');
            $table->unsignedBigInteger('Id_tipo');
            $table->unsignedBigInteger('Id_marca');
            $table->string('nome');
            $table->string('usuario')->unique();
            $table->timestamp('Usuario_verified_at')->nullable();
            $table->string('senha');
            $table->rememberToken();

            $table->foreign('Id_estoque')->references('id')->on('estoques');
            $table->foreign('Id_produto')->references('id')->on('produtos');
            $table->foreign('Id_relatorio')->references('id')->on('relatorios');
            $table->foreign('Id_nota_fiscal')->references('id')->on('nota_fiscals');
            $table->foreign('Id_supervisor')->references('id')->on('supervisors');
            $table->foreign('Id_doador')->references('id')->on('doadors');
            $table->foreign('Id_medida')->references('id')->on('medidas');
            $table->foreign('Id_tipo')->references('id')->on('tipos');
            $table->foreign('Id_marca')->references('id')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administradors');
    }
}
