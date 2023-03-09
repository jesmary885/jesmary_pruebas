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
        Schema::table('pago_registros_recargas', function (Blueprint $table) {
            $table->string('monto')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('nro_referencia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pago_registros_recargas', function (Blueprint $table) {
            //
        });
    }
};
