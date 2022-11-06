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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ISBN')->unsigned();
            $table->bigInteger('order_num')->unsigned();
            $table->integer('price_each');
            $table->integer('quantity');

            $table->foreign('ISBN')->references('ISBN')->on('products')->onDelete('cascade');
            $table->foreign('order_num')->references('order_num')->on('orders')->onDelete('cascade');


            
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
        Schema::dropIfExists('orderdetails');
    }
};
