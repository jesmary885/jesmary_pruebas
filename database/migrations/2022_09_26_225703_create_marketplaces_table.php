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
        Schema::create('marketplaces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->longText('description');
            $table->string('price');
            $table->string('cant');
            $table->string('points')->nullable(); //reputacion o puntos que ha recibido de los compradores
            $table->string('sales')->nullable();
            $table->string('status');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_marketplace_id');
            $table->foreign('category_marketplace_id')->references('id')->on('category_marketplaces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplaces');
    }
};
