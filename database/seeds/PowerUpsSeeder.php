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
            ['id' => 1, 'name' => 'damage', 'flavor_text' => 'The crystal radiates a bright blue and you feel its energy course through you.'],
            ['id' => 2, 'name' => 'health', 'flavor_text' => 'You quaff the large crimson potion and feel rejuvenated.'],
            ['id' => 3, 'name' => 'defense', 'flavor_text' => 'As you finish the potion a faint ward forms around you.'],
            ['id' => 4, 'name' => 'attack', 'flavor_text' => 'The very smell of the verdant green potion awakens you and you feel more agile.'],
        ];

        PowerUp::insert($powerups);
    }
}
