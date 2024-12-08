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
        Schema::create('degree_teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_num');
            $table->string('name');
            $table->string('email');
            $table->string('designation');
            $table->string('bcs_batch');
            $table->string('first_joining');
            $table->string('present_joining');
            $table->string('date_of_birth');
            $table->string('rcl_date');
            $table->string('blood_group');
            $table->string('photo');
            $table->string('mobile_no')->nullable();
            $table->string('home_dis')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('degree_teachers');
    }
};
