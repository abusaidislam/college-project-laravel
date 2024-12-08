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
        Schema::create('seat_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('exam_routin_id');
            $table->integer('room_num');
            $table->integer('depart_id');
            $table->integer('class_id');
            $table->string('session');
            $table->integer('roll');
            $table->integer('type');
            $table->integer('exam_id');
            $table->integer('total_row')->nullable();
            $table->string('starting_roll');
            $table->string('rending_rolloll');
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
        Schema::dropIfExists('seat_plans');
    }
};
