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
        Schema::create('d_r_analyses', function (Blueprint $table) {
            $table->id();
            $table->text('examname_year')->nullable();
            $table->text('collegecode_name')->nullable();
            $table->text('subjectcode_name')->nullable();
            $table->text('papercode_name')->nullable();
            $table->string('exam_roll')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('session')->nullable();
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
        Schema::dropIfExists('d_r_analyses');
    }
};
