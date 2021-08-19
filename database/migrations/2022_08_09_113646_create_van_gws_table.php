<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanGWSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_gws', function (Blueprint $table) {
            $table->id();
            $table->string('vanNumber');
            $table->foreignId('gwschedule_id')->references('id')->on('gwschedules');
            $table->foreignId('van_id')->references('id')->on('vans');
        
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
        Schema::dropIfExists('van_g_w_s');
    }
}
