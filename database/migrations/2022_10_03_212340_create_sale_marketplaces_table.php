<?php

use App\Models\saleMarketplace;
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
        Schema::create('sale_marketplaces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('cant');
            $table->string('total_paid')->nullable();
            $table->string('status');
  
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');

            $table->unsignedBigInteger('marketplace_id');
            $table->foreign('marketplace_id')->references('id')->on('marketplaces');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('points_producto')->nullable();
            $table->string('points_vendedor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_marketplaces');
    }
};
