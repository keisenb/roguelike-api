<?php

use Illuminate\Database\Seeder;
use App\CharacterClass;

class CharacterClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('character_class')->delete();

        $classes = [
            ['id' => 1, 'name' => 'Knight', 'starting_health' => 25, 'starting_attack_bonus' => 0,
            'starting_damage_bonus' => 1, 'starting_defense_bonus' => 2, 'starting_weapon' => 1,
            'starting_armor' => 4, 'options' => ""],

            ['id' => 2, 'name' => 'Archer', 'starting_health' => 10, 'starting_attack_bonus' => 2,
            'starting_damage_bonus' => 0, 'starting_defense_bonus' => 1, 'starting_weapon' => 7,
            'starting_armor' => 4, 'options' => ""],

            ['id' => 3, 'name' => 'Mage', 'starting_health' => 10, 'starting_attack_bonus' => -1,
            'starting_damage_bonus' => 2, 'starting_defense_bonus' => 1, 'starting_weapon' => 14,
            'starting_armor' => 3, 'options' => ""],

            ['id' => 4, 'name' => 'Zombie', 'starting_health' => 10, 'starting_attack_bonus' => 0,
            'starting_damage_bonus' => 0, 'starting_defense_bonus' => 0, 'starting_weapon' => 5,
            'starting_armor' => 1, 'options' => "{\"sense_range\":5,\"score\":5}"],

            ['id' => 5, 'name' => 'Skeleton', 'starting_health' => 8, 'starting_attack_bonus' => -1,
            'starting_damage_bonus' => -2, 'starting_defense_bonus' => -1, 'starting_weapon' => 10,
            'starting_armor' => 2, 'options' => "{\"sense_range\":10,\"prefDist\":4,\"attackCooldown\":2,\"moveOrAttack\":0,\"score\":10}"],

            ['id' => 6, 'name' => 'Minotaur', 'starting_health' => 25, 'starting_attack_bonus' => 2,
            'starting_damage_bonus' => 2, 'starting_defense_bonus' => 2, 'starting_weapon' => 4,
            'starting_armor' => 6, 'options' => "{\"sense_range\":15,\"score\":35}"],

            ['id' => 7, 'name' => 'Shaman', 'starting_health' => 15, 'starting_attack_bonus' => 1,
            'starting_damage_bonus' => 1, 'starting_defense_bonus' => 1, 'starting_weapon' => 14,
            'starting_armor' => 3, 'options' => "{\"sense_range\":10,\"prefDist\":5,\"attackCooldown\":2,\"moveOrAttack\":0,\"score\":20}"],

            ['id' => 8, 'name' => 'Fucking Dragon', 'starting_health' => 30, 'starting_attack_bonus' => 3,
            'starting_damage_bonus' => 5, 'starting_defense_bonus' => 3, 'starting_weapon' => 15,
            'starting_armor' => 8, 'options' => "{\"sense_range\":20,\"prefDist\":3,\"attackCooldown\":3,\"moveOrAttack\":0,\"score\":100}"],
        ];

        CharacterClass::insert($classes);
    }
}
