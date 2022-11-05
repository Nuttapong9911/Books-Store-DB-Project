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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('emp_num');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('job_title');
            $table->string('extension');
            $table->bigInteger('supervisor')->unsigned()->nullable();
            $table->bigInteger('office_code')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('supervisor')->references('emp_num')->on('employees')->onDelete('set null');
            $table->foreign('office_code')->references('office_code')->on('offices')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
