<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('thumbnail', 255);
            $table->unsignedBigInteger('price');
            $table->text('describe');
            $table->text('content');
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') -> references('id') ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id') -> references('id') ->on('product_cats')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
