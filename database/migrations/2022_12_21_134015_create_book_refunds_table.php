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
        Schema::create('book_refunds', function (Blueprint $table) {
            $table->id();
            $table->integer('card_id');
            $table->integer('book_id');
            $table->integer('numberofbook');
            $table->string('author_name');
            $table->string('date_of_return');
            $table->string('due_date');
            $table->string('late_fine');
            $table->string('book_condition');
            $table->text('comments');
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
        Schema::dropIfExists('book_refunds');
    }
};
