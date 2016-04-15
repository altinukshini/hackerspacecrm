<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id')->unique();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('socialid')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('address')->nullable();
            $table->mediumText('biography')->nullable();
            $table->string('skills')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('github_username')->nullable();
            $table->string('facebook_username')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('linkedin_username')->nullable();
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
        Schema::drop('profiles');
    }
}
