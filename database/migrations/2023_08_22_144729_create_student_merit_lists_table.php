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
        Schema::create('student_merit_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('depart_id');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->string('name');
            $table->string('student_class_year');
            $table->integer('total_result');
            $table->integer('atten_mark');
            $table->integer('merit_marks');
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
        Schema::dropIfExists('student_merit_lists');
    }
};
