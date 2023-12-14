<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_produtos', function (Blueprint $table) {           
                $table->increments('id');
                $table->integer('usuario_id')->unsigned(); 
                $table->integer('compra_id')->unsigned();
                $table->integer('produto_id')->unsigned();
                $table->integer('datahora');    
                $table->decimal('valor_un');
                $table->decimal('valor_total');
                $table->float('quantidade');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
                $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
                $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('compra_produtos');
    }
}
