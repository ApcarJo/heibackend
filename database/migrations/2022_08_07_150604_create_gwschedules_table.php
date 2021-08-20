<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGwschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gwschedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->require();
            $table->string('competition')->default('Liga1');
            $table->string('GW')->nullable();
            $table->string('kickOff')->default('21:00');
            $table->foreignId('stadium_id')->references('id')->on('stadia');
            $table->boolean('isMd-1')->default(false);
            $table->boolean('isActive')->default(true);
            $table->boolean('isArchive')->default(false);
            $table->string('vlan')->default(false);
            $table->string('port')->default(false);
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
        Schema::dropIfExists('gwschedules');
    }
}
