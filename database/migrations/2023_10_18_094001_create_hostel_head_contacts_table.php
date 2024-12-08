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
        Schema::create('hostel_head_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('hostel_name');
            $table->string('title');
            $table->string('dept_name');
            $table->string('designation');
            $table->string('mobile');
            $table->integer('hostel_id');
            $table->string('photo');
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
        Schema::dropIfExists('hostel_head_contacts');
    }
};
