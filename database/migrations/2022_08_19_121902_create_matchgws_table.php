<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchgwsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchgws', function (Blueprint $table) {
            $table->id();
            $table->string('GW');
            $table->string('Competition');
            $table->foreignId('gwschedule_id')->references('id')->on('gwschedules');
            $table->foreignId('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('matchgws');
    }
}
