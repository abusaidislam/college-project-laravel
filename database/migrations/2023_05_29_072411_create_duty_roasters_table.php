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
        Schema::create('duty_roasters', function (Blueprint $table) {
            $table->id();
            $table->string('exam_name');
            $table->string('name');
            $table->string('designation');
            $table->string('department');
            $table->string('email');
            $table->date('duty_date');
            $table->string('duty_time');
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
        Schema::dropIfExists('duty_roasters');
    }
};
