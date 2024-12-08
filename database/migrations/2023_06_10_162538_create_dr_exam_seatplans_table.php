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
        Schema::create('dr_exam_seatplans', function (Blueprint $table) {
            $table->id();
            $table->integer('room_num');
            $table->integer('roll');
            $table->integer('type');
            $table->string('year');
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
        Schema::dropIfExists('dr_exam_seatplans');
    }
};
