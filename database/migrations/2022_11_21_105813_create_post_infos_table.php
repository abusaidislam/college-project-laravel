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
        Schema::create('post_infos', function (Blueprint $table) {
            $table->id();
            $table->string('college_name');
            $table->integer('a_id');
            $table->string('designation');
            $table->string('fromdate');
            $table->string('todate');
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
        Schema::dropIfExists('post_infos');
    }
};
