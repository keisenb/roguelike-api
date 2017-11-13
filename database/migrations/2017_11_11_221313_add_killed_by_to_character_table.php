<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKilledByToCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('characters', function(Blueprint $table){
            $table->integer('killed_by')->unsigned();
            $table->foreign('killed_by')->references('id')->on('characters');

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('characters', function(Blueprint $table){
            $table->dropColumn('killed_by');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
