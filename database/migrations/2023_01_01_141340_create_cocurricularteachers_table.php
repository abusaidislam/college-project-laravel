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
        Schema::create('cocurricularteachers', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('email');
            $table->string('photo');
            $table->string('designation');
             $table->string('teachertype');
            $table->string('mobile_no')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('home_dis')->nullable();
            $table->string('first_join')->nullable();
            $table->string('present_join')->nullable();
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
        Schema::dropIfExists('cocurricularteachers');
    }
};
