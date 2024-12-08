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
        Schema::create('hostel_seat_allotments', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->string('student_name');
            $table->integer('roll');
            $table->string('session');
            $table->integer('bulding_id');
            $table->integer('floor_id');
            $table->integer('room_id');
            $table->integer('bed_id');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('photo');
            $table->string('payment_amount');
            $table->string('registration');
            $table->string('mobile_no');
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
        Schema::dropIfExists('hostel_seat_allotments');
    }
};
