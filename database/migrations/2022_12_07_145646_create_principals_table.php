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
        Schema::create('principals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('photo');
            $table->string('designation');
            $table->string('department');
            $table->string('bcs_batch')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('home_dis')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
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
        Schema::dropIfExists('principals');
    }
};
