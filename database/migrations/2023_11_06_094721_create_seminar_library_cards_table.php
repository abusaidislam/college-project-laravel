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
        Schema::create('seminar_library_cards', function (Blueprint $table) {
            $table->id();   
            $table->string('department_id');
            $table->string('student_name');
            $table->string('class');
            $table->string('roll');
            $table->string('card_no');
            $table->string('session');
            $table->string('registration')->nullable();
            $table->string('date')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('seminar_library_cards');
    }
};
