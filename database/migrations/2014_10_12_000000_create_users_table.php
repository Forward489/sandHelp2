<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            // $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('name');
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('description')->nullable();
            $table->string('profile_picture')->nullable();
            $table->integer('points')->default(0);
            $table->date('birthdate')->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_verified')->default(0);
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
};
