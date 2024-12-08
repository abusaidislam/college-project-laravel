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
        Schema::create('hostel_id_cards', function (Blueprint $table) {
            $table->id();
            $table->string('s_name');
            $table->string('deprartment');
            $table->string('session');
            $table->string('class');
            $table->string('roll');
            $table->string('registration');
            $table->string('mobile_no');
            $table->string('blood_group');
            $table->string('bulding_name');
            $table->string('floor_name');
            $table->string('room_number');
            $table->string('seat_number');
            $table->string('card_no');
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
        Schema::dropIfExists('hostel_id_cards');
    }
};
