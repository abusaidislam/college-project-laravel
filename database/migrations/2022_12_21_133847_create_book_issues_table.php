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
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->string('card_no');
            $table->integer('book_id');
            $table->string('author');
            $table->integer('number_of_book');
            $table->integer('number_of_remaining_book');
            $table->string('date_of_issue_book');
            $table->string('date_of_return_book');
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
        Schema::dropIfExists('book_issues');
    }
};
