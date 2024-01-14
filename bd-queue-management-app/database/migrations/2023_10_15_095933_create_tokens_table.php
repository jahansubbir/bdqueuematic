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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('counter_id');
            $table->unsignedBigInteger('booth_id');
            $table->unsignedBigInteger('token_type_id');
            $table->foreign('counter_id')->references('id')->on('counters');
            $table->foreign('booth_id')->references('id')->on('booths');
            $table->foreign('token_type_id')->references('id')->on('token_types');
            $table->time('appointment_start');
            $table->time('appointment_end');
            $table->string('token_no');
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
        Schema::dropIfExists('tokens');
    }
};
