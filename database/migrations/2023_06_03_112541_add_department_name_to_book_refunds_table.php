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
        Schema::table('book_refunds', function (Blueprint $table) {
            $table->string('department_name')->nullable()->after('book_name');
            $table->string('student_name')->nullable()->after('department_name');
            $table->string('roll')->nullable()->after('student_name');
            $table->string('registration_no')->nullable()->after('roll');
            $table->string('session')->nullable()->after('registration_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_refunds', function (Blueprint $table) {
          //
        });
    }
};
