<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //Persona que recibe el comentario
            $table->foreignId('user_id')->constrained();

            $table->string('posicion');
            $table->string('comment');
            $table->string('categoria_comentario'); //positivo o negativo


             //Persona que hace el comentario
             $table->unsignedBigInteger('user_create_id');
             $table->foreign('user_create_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_users');
    }
};
