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
        Schema::create('payments', function (Blueprint $table) {
            $table->string('check_num');
            $table->date('payment_date');
            $table->integer('amount');
            $table->bigInteger('customer_ID')->unsigned();

            $table->foreign('customer_ID')->references('customer_ID')->on('customers')->onDelete('cascade');

            $table->primary(['check_num', 'customer_ID']);

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
        Schema::dropIfExists('payments');
    }
};
