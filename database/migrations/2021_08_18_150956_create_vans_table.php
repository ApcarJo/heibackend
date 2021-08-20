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
            $table->string('vanNumber')->require();
            $table->string('model');
            $table->string('licensePlate')->require();
            $table->string('crossCheckCode')->nullable();
            $table->date('ITV')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('gas')->default('Diesel');
            $table->string('bastidor')->nullable();
            $table->date('lastInspectionDate')->nullable();
            $table->string('KMs')->nullable();
            $table->boolean('isActive')->default(true);

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
