<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeaponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('attack_type');
            $table->integer('max_damage');
            $table->integer('min_damage');
            $table->string('damage_type');
            $table->integer('range');
            $table->integer('hit_bonus');
            $table->string('attack_effect');
            $table->string('properties');
            $table->string('properties_short');
            $table->integer('sprite_id');
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
        Schema::dropIfExists('weapons');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
