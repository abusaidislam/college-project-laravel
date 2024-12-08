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
        Schema::create('degree_student_results', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject');
            $table->double('written_mark');
            $table->double('marks');
            $table->integer('student_id');
            $table->string('years');
            $table->integer('class_id');
            $table->integer('student_class_year');
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
        Schema::dropIfExists('degree_student_results');
    }
};
