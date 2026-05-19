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
        Schema::create('cuentas_ssis', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedBigInteger('trabajador_id')->nullable();
            $table->foreign('trabajador_id')->references('id')->on('users');

            $table->string('type_cuenta');

            $table->string('estado');
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
        Schema::dropIfExists('cuentas_ssis');
    }
};
