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
        Schema::create('marketplace_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('marketplace_id');
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');

            $table->unsignedBigInteger('payment_methods_id');
            $table->foreign('payment_methods_id')->references('id')->on('payment_methods');

            //$table->string('bill');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplace_payment_methods');
    }
};
