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
        Schema::create('degree_class_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->text('fitst');
            $table->text('scend');
            $table->text('third');
            $table->text('forth');
            $table->text('fifth');
            $table->text('sixth');
            $table->text('seventh');
            $table->text('eight');
            $table->text('nine');
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
        Schema::dropIfExists('degree_class_schedules');
    }
};
