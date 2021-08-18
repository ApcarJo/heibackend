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
            $table->string('gw')->unique();
            $table->foreignId('home_id')->references('id')->on('teams');
            $table->foreignId('away_id')->references('id')->on('teams');
            $table->string('kickOff')->require();
            $table->foreignId('stadium_id')->references('id')->on('stadiums');
            // $table->foreignId('van_id')->references('id')->on('vans');
            $table->foreignId('tg1_user_id')->references('id')->on('users');
            $table->foreignId('tg2_user_id')->references('id')->on('users');
            $table->foreignId('vtg_user_id')->references('id')->on('users');
            $table->foreignId('ro_user_id')->references('id')->on('users');
            $table->foreignId('aro_user_id')->references('id')->on('users');
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
