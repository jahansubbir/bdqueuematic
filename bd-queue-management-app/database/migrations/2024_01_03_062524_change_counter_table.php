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
        //
        Schema::table('counters', function (Blueprint $table) {
            $table->time('opening_hour');
            $table->time('closing_hour');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('counters', function (Blueprint $table) {
            $table->dropColumn('opening_hour');
            $table->dropColumn('closing_hour');
            

        });
    }
};
