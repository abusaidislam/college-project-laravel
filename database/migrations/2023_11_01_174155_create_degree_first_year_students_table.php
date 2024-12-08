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
        Schema::create('degree_first_year_students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mather_name')->nullable();
            $table->string('email')->nullable();
            $table->integer('studentclass')->nullable();
            $table->integer('register_roll')->nullable();
            $table->string('session')->nullable();
            $table->string('photo')->nullable();
            $table->string('roll')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->string('blood_group')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('father_mobile')->nullable();
            $table->string('home_dis')->nullable();
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
        Schema::dropIfExists('degree_first_year_students');
    }
};
