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
        Schema::create('annual_committees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('designation');
            $table->string('academic_designation');
            $table->string('department');
            $table->string('bcs_batch');
            $table->string('mobile_no');
            $table->integer('type');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('annual_committees');
    }
};
