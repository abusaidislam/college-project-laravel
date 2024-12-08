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
        Schema::create('seminar_personnels', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_num');
            $table->integer('depart_id');
            $table->string('name');
            $table->string('email');
            $table->string('photo');
            $table->string('designation');
            $table->string('mobile_no');
            $table->string('blood_group');
            $table->string('home_dis');
            $table->string('first_join');
            $table->string('present_join');
            $table->date('date_of_birth');
            $table->string('rcl_date');
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
        Schema::dropIfExists('seminar_personnels');
    }
};
