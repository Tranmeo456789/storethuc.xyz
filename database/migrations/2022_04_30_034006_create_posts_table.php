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
            $table->string('title',200);
            $table->string('thumbnail', 200);
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') -> references('id') ->on ('users')->onDelete('cascade');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id') -> references('id') ->on ('post_cats')->onDelete('cascade');
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
