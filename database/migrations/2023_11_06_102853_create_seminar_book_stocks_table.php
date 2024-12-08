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
        Schema::create('seminar_book_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->integer('depart_id');
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
        Schema::dropIfExists('seminar_book_stocks');
    }
};
