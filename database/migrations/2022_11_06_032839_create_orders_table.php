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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_num');
            $table->string('status');
            $table->text('comments')->nullable();
            $table->date('shipped_date')->nullable();
            $table->date('order_date');
            $table->bigInteger('customer_ID')->unsigned();


            $table->foreign('customer_ID')->references('customer_ID')->on('customers')->onDelete('cascade');

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
};
