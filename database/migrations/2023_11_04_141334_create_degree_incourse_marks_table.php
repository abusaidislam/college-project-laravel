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
        Schema::create('degree_incourse_marks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->string('course_code');
            $table->string('student_class_year');
            $table->string('years');
            $table->integer('total_result');
            $table->integer('incourse_mark');
            $table->integer('atten_marks');
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
        Schema::dropIfExists('degree_incourse_marks');
    }
};
