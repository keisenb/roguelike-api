<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('health');
            $table->integer('attack_bonus');
            $table->integer('damage_bonus');
            $table->integer('defense_bonus');
            $table->unsignedInteger('weapon_id');
            $table->foreign('weapon_id')->references('id')->on('weapons');
            $table->unsignedInteger('armor_id');
            $table->foreign('armor_id')->references('id')->on('armors');
            $table->unsignedInteger('class_id');
            $table->foreign('class_id')->references('id')->on('character_class');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('characters');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
