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
        Schema::create('products', function (Blueprint $table) {
            $table->id('ISBN');
            $table->string('product_name');
            $table->text('product_description');
            $table->integer('page_num');
            $table->string('publisher');
            $table->date('published_date');
            $table->string('author_name');
            $table->string('image');

            $table->integer('quality_stock');
            $table->string('buy_price');

            $table->bigInteger('type_ID')->unsigned();
            
            $table->foreign('type_ID')->references('type_ID')->on('producttypes')->onDelete('cascade');

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
};
