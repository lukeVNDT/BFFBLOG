<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
  ->references('id')->on('users')
  ->onDelete('cascade');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('number');
            $table->text('address');
            $table->string('country');
            $table->longText('shortdescription')->nullable();
            $table->longText('details');
            $table->text('fb_link');
            $table->text('github_link');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('profile');
    }
}
