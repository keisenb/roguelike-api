<?php

use Illuminate\Database\Seeder;
use App\PowerUp;

class PowerUpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('power_ups')->delete();

        $powerups = [
            ['id' => 1, 'name' => 'damage'],
            ['id' => 2, 'name' => 'health'],
            ['id' => 3, 'name' => 'defense'],
            ['id' => 4, 'name' => 'attack'],
        ];

        PowerUp::insert($powerups);
    }
}
