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
        Schema::create('degree_secound_year_students', function (Blueprint $table) {
            $table->id();
            $table->string('session_year')->nullable();
            $table->string('student_name')->nullable();
            $table->string('roll')->nullable();
            $table->string('registration_no')->unique()->nullable(); 
            $table->integer('class_id')->nullable();
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
        Schema::dropIfExists('degree_secound_year_students');
    }
};
