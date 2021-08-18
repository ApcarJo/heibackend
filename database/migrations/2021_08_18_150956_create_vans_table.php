<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vans', function (Blueprint $table) {
            $table->id();

            $table->string('customNote')->require();
            $table->string('model');
            $table->string('licensePlate')->require();
            $table->string('crossCheckCode');
            $table->date('ITV');
            $table->string('weight');
            $table->string('height');
            $table->string('gas');
            $table->string('bastidor');
            $table->date('lastInspectionDate');
            $table->boolean('isActive');


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
        Schema::dropIfExists('vans');
    }
}
