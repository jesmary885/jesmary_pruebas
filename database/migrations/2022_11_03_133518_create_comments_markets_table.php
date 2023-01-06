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
        Schema::create('comments_markets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('comment')->nullable();

            $table->unsignedBigInteger('marketplace_id');
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments_markets');
    }
};
