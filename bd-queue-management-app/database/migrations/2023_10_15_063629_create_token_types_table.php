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
        Schema::create('token_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('process_duration');
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
        Schema::table('token_types', function (Blueprint $table) {
        //    $table->dropForeign('tokens_token_type_id_foreign');
        });
      
        Schema::dropIfExists('token_types');
        // Schema::table('tokens', function (Blueprint $table) {
        //     $table->dropForeign(['tokens_token_type_id_foreign']);
        // });
    }
};
