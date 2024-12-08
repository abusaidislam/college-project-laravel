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
        Schema::create('irregular_non_form_fill_up_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('depart_id');
            $table->string('dname');
            $table->integer('class_id');
            $table->string('session');
            $table->string('fee_name');
            $table->decimal('fee_amount', 8, 2);
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
        Schema::dropIfExists('irregular_non_form_fill_up_fees');
    }
};
