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
            $table->timestamps();

            $table->date('date')->require();
            $table->string('competition')->require();
            $table->string('gw')->unique();
            $table->string('home_team_id')->require();
            $table->string('away_team_id')->require();
            $table->string('kickOff')->require();
            $table->string('stadium_id')->require();
            $table->string('van_id')->nullable();
            $table->boolean('tg1_user_id')->default(false);
            $table->string('tg2_user_id')->nullable();
            $table->string('vtg_user_id')->nullable();
            $table->string('ro_user_id')->nullable();
            $table->string('aro_user_id')->nullable();
            $table->boolean('isMd-1')->default(false);
            $table->string('vlan')->default(false);
            $table->string('port')->default(false);

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
