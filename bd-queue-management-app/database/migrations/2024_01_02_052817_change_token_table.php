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
        Schema::table('tokens', function (Blueprint $table) {
            $table->dropColumn('scv_code');
            $table->bigInteger('user_id');
            

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
        Schema::table('tokens', function (Blueprint $table) {
            $table->string('scv_code');
            $table->dropColumn('user_id');
            

        });
    }
};
