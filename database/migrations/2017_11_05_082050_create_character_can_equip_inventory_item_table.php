<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterCanEquipInventoryItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_can_equip_inventory_item', function (Blueprint $table) {
            $table->unsignedInteger('character_class_id');
            $table->foreign('character_class_id')->references('id')->on('character_class');
            $table->unsignedInteger('item_id');
            $table->foreign('item_id')->references('id')->on('inventory_items');
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
        Schema::dropIfExists('character_can_equip_inventory_item');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
