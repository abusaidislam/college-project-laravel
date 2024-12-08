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
        Schema::table('book_issues', function (Blueprint $table) {
            $table->integer('number_of_book')->after('book_name');
            $table->integer('number_of_remaining_book')->nullable()->after('number_of_book');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_issues', function (Blueprint $table) {
            //
        });
    }
};
