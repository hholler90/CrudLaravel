<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilPermissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_permissao', function (Blueprint $table) {
            $table->integer('perfil_id')->unsigned();
            $table->integer('permissao_id')->unsigned();
            $table->foreign('perfil_id')->references('id')->on('perfis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('permissao_id')->references('id')->on('permissoes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}

