<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_class', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('starting_health');
            $table->integer('starting_attack_bonus');
            $table->integer('starting_damage_bonus');
            $table->integer('starting_defense_bonus');
            $table->unsignedInteger('starting_weapon');
            $table->foreign('starting_weapon')->references('id')->on('weapons');
            $table->unsignedInteger('starting_armor');
            $table->foreign('starting_armor')->references('id')->on('armors');
            $table->string('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('character_class');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
