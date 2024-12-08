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
        Schema::create('form_fill_up_fees', function (Blueprint $table) {
            $table->id();
            $table->string('dname');
            $table->string('class_name');
            $table->string('sname');
            $table->string('session');
            $table->string('roll');
            $table->string('regino');
            $table->string('regi_type');
            $table->text('course_code');
            $table->decimal('amount', 10, 2);
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
        Schema::dropIfExists('form_fill_up_fees');
    }
};
