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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('scv_code');
            $table->string('cnf_name');
            $table->string('ain_no');
            $table->string('contact_no');

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
        Schema::table('users', function (Blueprint $table) {
            $table->string('scv_code');
            $table->dropColumn('cnf_name');
            $table->dropColumn('ain_no');
            $table->dropColumn('contact_no');

        });

    }
};
