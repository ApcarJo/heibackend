<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->unique();
            $table->string('stadium_id')->unique();
            $table->boolean('isFD')->require();
            $table->boolean('isUCL')->default(false);
            $table->boolean('isUEL')->default(false);
            $table->boolean('isSC')->default(false);
            $table->boolean('isCDR')->default(false);

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
