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
        Schema::create('exam_dr_seat_seatings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('exam_routin_id');
            $table->integer('room_num');
            $table->text('exam_year');
            $table->text('collegee_name');
            $table->text('subject_name');
            $table->integer('roll');
            $table->integer('type');
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
        Schema::dropIfExists('exam_dr_seat_seatings');
    }
};
