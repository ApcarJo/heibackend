<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Stadium', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->unique();
            $table->string('address')->unique();
            $table->string('tvCompound')->nullable();
            $table->string('contact')->nullable();
            $table->string('docs')->nullable();
            $table->boolean('isActive')->default(true);
            $table->boolean('isGLT')->default(false);
            $table->boolean('isRobot')->nullable();
            $table->boolean('hasRraCover')->default(true);
            $table->string('information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Stadium');
    }
}
