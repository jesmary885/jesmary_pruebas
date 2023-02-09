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
        Schema::create('pago_registros_recargas', function (Blueprint $table) {
            $table->id();

            //Cliente que paga
            $table->foreignId('user_id')->constrained();

            $table->string('file');
            $table->string('plan');
            $table->string('comentario')->nullable(); 
            $table->string('status');

            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');

             //Administrador que verifica el pago
            $table->unsignedBigInteger('admin_first_id')->nullable();
            $table->foreign('admin_first_id')->references('id')->on('users');

             //Segundo administrador que verifica el pago
            $table->unsignedBigInteger('admin_second_id')->nullable();
            $table->foreign('admin_second_id')->references('id')->on('users');

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
        Schema::dropIfExists('pago_registros_recargas');
    }
};
