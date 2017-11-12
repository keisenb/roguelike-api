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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('character_class');
    }
}
