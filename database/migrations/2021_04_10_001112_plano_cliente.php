<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlanoCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('plano_cliente', function (Blueprint $table) {
        $table->unsignedBigInteger('plano_id');
        $table->unsignedBigInteger('cliente_id');

        $table->foreign('plano_id')->references('id')->on('planos');
        $table->foreign('cliente_id')->references('id')->on('clientes');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('plano_cliente');
    }
}
