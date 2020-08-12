<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Id_doador')->nullable();
            $table->unsignedBigInteger('Id_produto')->nullable();
            $table->unsignedBigInteger('Id_entrada')->nullable();
            $table->enum('tipo', ['entrada', 'geral', 'baixa', 'vencimento', 'todo_periodo', 'saida']);
            $table->string('relatorio');
            $table->string('data');
            $table->timestamps();

            $table->foreign('Id_doador')->references('id')->on('doadors')->onDelete('cascade');
            $table->foreign('Id_produto')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('Id_entrada')->references('id')->on('produto_em_estoques')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('relatorios');
        Schema::enableForeignKeyConstraints();
    }
}
