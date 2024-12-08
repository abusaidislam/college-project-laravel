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
        Schema::create('student_incourse_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('depart_id');
            $table->string('name');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->string('student_class_year');
            $table->string('years');
            $table->string('course_code');
            $table->integer('total_result');
            $table->integer('written1st_marks');
            $table->integer('atten1st_marks');
            $table->integer('total1st_result');
            $table->integer('written2nd_marks');
            $table->integer('atten2nd_marks');
            $table->integer('total2nd_result');
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
        Schema::dropIfExists('student_incourse_marks');
    }
};
