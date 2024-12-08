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
        Schema::create('bookstocks', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('book_name');
            $table->string('author');
            $table->string('publiction');
            $table->string('edition');
            $table->string('number_of_copies');
            $table->string('volumn');
            $table->string('date');
            $table->string('price');
            $table->string('status');
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
        Schema::dropIfExists('bookstocks');
    }
};
