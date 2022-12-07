<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('thumbnail', 255);
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('unit_id');
            $table->text('describe');
            $table->text('content');
            $table->string('status');
            $table->string('slug');
            $table->unsignedBigInteger('cat_id');
            $table->string('image', 255);
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
        Schema::dropIfExists('product');
    }
}
