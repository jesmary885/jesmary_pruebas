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
        Schema::table('cuentas_ktmrs', function (Blueprint $table) {
            $table->longText('link_inicial')->change()->nullable();
            $table->longText('link_resultado')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuentas_ktmrs', function (Blueprint $table) {
            //
        });
    }
};
