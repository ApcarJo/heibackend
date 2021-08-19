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
            $table->string('competition')->require();
            $table->string('GW')->unique();
            $table->string('kickOff')->require();
            $table->foreignId('stadium_id')->references('id')->on('stadiums');
            // $table->foreignId('userTeam_id')->references('id')->on('user_teams');
            // $table->foreignId('vanGW_id')->references('id')->on('van_gws');
            $table->boolean('isMd-1')->default(false);
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
