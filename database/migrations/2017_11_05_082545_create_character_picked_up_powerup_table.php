<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterPickedUpPowerupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_picked_up_powerup', function (Blueprint $table) {
            $table->unsignedInteger('character_id');
            $table->foreign('character_id')->references('id')->on('characters');
            $table->unsignedInteger('power_up_id');
            $table->foreign('power_up_id')->references('id')->on('power_ups');
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
        Schema::dropIfExists('character_picked_up_powerup');
    }
}
