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
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();
            $table->integer('depart_id');
            $table->integer('class_id');
            $table->string('session');
            $table->string('sname');
            $table->string('roll');
            $table->string('regi_no');
            $table->string('user_name');
            $table->string('password');
            $table->string('text_password');
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
        Schema::dropIfExists('student_admissions');
    }
};
