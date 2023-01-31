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
        Schema::table('comment_users', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_marketplace_id');
            $table->foreign('sale_marketplace_id')->references('id')->on('sale_marketplaces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comment_users', function (Blueprint $table) {
            //
        });
    }
};
