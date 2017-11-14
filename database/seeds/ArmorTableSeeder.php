<?php

use Illuminate\Database\Seeder;
use App\Armor;

class ArmorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('armors')->delete();

        $armors = [
            ['id' => 1, 'name' => 'Flesh', 'defense_value' => 3,
            'strong_type' => '', 'weak_type' => 'spb'],

            ['id' => 2, 'name' => 'Bones', 'defense_value' => 5,
            'strong_type' => 'p', 'weak_type' => 'b'],

            ['id' => 3, 'name' => 'Robes', 'defense_value' => 5,
            'strong_type' => 'spb', 'weak_type' => ''],

            ['id' => 4, 'name' => 'Hide Armor', 'defense_value' => 8,
            'strong_type' => 'b', 'weak_type' => 's'],

            ['id' => 5, 'name' => 'Leathers', 'defense_value' => 10,
            'strong_type' => 's', 'weak_type' => 'b'],

            ['id' => 6, 'name' => 'Chainmail', 'defense_value' => 12,
            'strong_type' => 's', 'weak_type' => 'p'],

            ['id' => 7, 'name' => 'Plate Armor', 'defense_value' => 15,
            'strong_type' => 'p', 'weak_type' => 'b'],

            ['id' => 8, 'name' => 'Dragon Scale', 'defense_value' => 18,
            'strong_type' => 'spb', 'weak_type' => ''],
        ];

        Armor::insert($armors);
    }
}
