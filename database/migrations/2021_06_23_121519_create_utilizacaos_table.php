<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilizacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('motivo');
            $table->datetime('dt_entrega');
            $table->datetime('dt_hora_saida')->nullable();
            $table->datetime('dt_hora_retorno')->nullable();
            $table->bigInteger('km_inicial')->nullable();
            $table->bigInteger('km_final')->nullable();
            $table->bigInteger('km_percorrido')->nullable();
            
            $table->string('cep')->nullable();
            $table->string('rua')->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('endereco')->nullable();
            $table->string('coordenador_email')->nullable();

            $table->string('status');
            $table->string('token');

            $table->unsignedBigInteger('motorista_id')->nullable();            
            $table->unsignedBigInteger('veiculo_id')->nullable();
            $table->foreign('user_id')->references('id')->on('veiculos');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('utilizacaos');
    }
}
