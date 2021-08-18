<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('customNote');
            $table->string('model');
            $table->string('type');
            $table->string('serialNumber');
            $table->string('year');
            $table->date('warrantyExpiracyDate');
            $table->integer('quantity');
            $table->string('crossCheckCode');
            $table->string('type');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('loomNumber');
            $table->foreignId('kit_van_id')->references('id')->on('vans');

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
        Schema::dropIfExists('assets');
    }
}
