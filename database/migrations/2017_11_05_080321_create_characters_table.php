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
            $table->unsignedInteger('weapon');
            $table->foreign('weapon')->references('id')->on('weapons');
            $table->unsignedInteger('armour');
            $table->foreign('armour')->references('id')->on('armors');
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
        Schema::dropIfExists('characters');
    }
}
