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
        Schema::create('teacher_councils', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('designation');
            $table->string('Academicdesignation');
            $table->string('department');
            $table->string('bcs_batch')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('teacher_councils');
    }
};
