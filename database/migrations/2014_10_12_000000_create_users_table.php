<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname1')->nullable();
            $table->string('surname2')->nullable();
            $table->string('email')->unique();
            $table->string('codename')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('picture')->nullable();
            $table->string('nif')->nullable();
            $table->boolean('license')->default(false);
            $table->string('postalcode')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('role')->nullable();
            $table->boolean('isActive')->default(true);
            $table->boolean('isAdmin')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
