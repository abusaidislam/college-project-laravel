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
        Schema::create('routine_time_sloats', function (Blueprint $table) {
            $table->id();
            $table->string("exam_name")->nullable();
            $table->string("time_1")->nullable();
            $table->string("time_2")->nullable();
            $table->string("time_3")->nullable();
            $table->string("time_4")->nullable();
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
        Schema::dropIfExists('routine_time_sloats');
    }
};
