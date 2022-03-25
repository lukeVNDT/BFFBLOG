<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
  ->references('id')->on('categories')
  ->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
  ->references('id')->on('users')
  ->onDelete('cascade');
            $table->string('title');
            $table->text('short_desc');
            $table->longText('description')->nullable();
            $table->string('imagepost')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
