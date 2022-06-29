<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code_order',100);
            $table->unsignedBigInteger('price_total');
            $table->unsignedBigInteger('qty_total');
            $table->string('status',100);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') -> references('id') ->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->string('status_delete',100);
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
        Schema::dropIfExists('orders');
    }
}
