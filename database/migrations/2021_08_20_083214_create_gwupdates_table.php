<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGwupdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gwupdates', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('title')->nullable();
            $table->string('roles')->nullable();
            $table->text('infoUpdate')->nullable();
            $table->string('img')->nullable();
            $table->boolean('isActive')->default(true);
            $table->boolean('isArchive')->default(false);
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
        Schema::dropIfExists('gwupdates');
    }
}
