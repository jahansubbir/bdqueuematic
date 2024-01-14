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
        Schema::table('booths', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('counter_id')->change();
            $table->unsignedBigInteger('booth_type_id')->change();
            $table->foreign('counter_id')->references('id')->on('counters');
            $table->foreign('booth_type_id')->references('id')->on('token_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booths', function (Blueprint $table) {
            //
        });
    }
};
