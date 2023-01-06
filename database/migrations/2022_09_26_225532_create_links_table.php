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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('psid')->nullable();
            $table->string('basic')->nullable();
            $table->string('high')->nullable();
            $table->string('pid')->nullable();
            $table->string('panel')->nullable();
            $table->string('observation')->nullable();
            $table->string('id_id')->nullable();
            $table->string('token')->nullable();
            $table->string('jumper')->nullable();
            $table->string('notch')->nullable();
            $table->string('k_detected')->nullable();
            $table->string('wix_detected')->nullable();
            $table->string('negative_points')->nullable();
            $table->string('positive_points')->nullable();

            $table->unsignedBigInteger('jumper_type_id');
            $table->foreign('jumper_type_id')->references('id')->on('jumper_types');

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
        Schema::dropIfExists('links');
    }
};
