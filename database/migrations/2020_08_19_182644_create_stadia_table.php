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
        Schema::create('stadia', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->unique();
            $table->string('address')->unique();
            $table->string('tvCompound')->nullable();
            $table->string('contact')->nullable();
            $table->string('contactPhone')->nullable();
            $table->string('docsLink')->nullable();
            $table->boolean('isActive')->default(true);
            $table->boolean('isGLT')->default(false);
            $table->boolean('isRobot')->default(false);
            $table->boolean('hasRraCover')->default(true);
            $table->string('information')->nullable();
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
        Schema::dropIfExists('stadia');
    }
}
