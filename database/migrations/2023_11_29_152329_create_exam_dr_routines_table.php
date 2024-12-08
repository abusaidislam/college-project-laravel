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
        Schema::create('exam_dr_routines', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('exam_id');
            $table->string('date');
            $table->string('day');
            $table->string('exam_time');
            $table->text('course_name')->nullable();
            $table->text('course_code')->nullable();
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
        Schema::dropIfExists('exam_dr_routines');
    }
};
