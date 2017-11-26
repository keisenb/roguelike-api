<?php

use Illuminate\Database\Seeder;
use App\Weapon;

class WeaponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weapons')->delete();

        $weapons = [
            ['id' => 1, 'name' => 'Longsword', 'attack_type' => 'Melee',
            'max_damage' => 10, 'min_damage' => 2, 'damage_type' => 's',
            'range' => 1, 'hit_bonus' => 0, 'attack_effect' => '',
            'properties' => '+1 Min Damage', 'properties_short' => '',
            'sprite_id' => 3],

            ['id' => 2, 'name' => 'Morning Star', 'attack_type' => 'Melee',
            'max_damage' => 8, 'min_damage' => 1, 'damage_type' => 'b',
            'range' => 1, 'hit_bonus' => 2, 'attack_effect' => 'Stunned',
            'properties' => '+2 Accuracy, 50% Stun Chance',
            'properties_short' => '50% Stun', 'sprite_id' => 2],

            ['id' => 3, 'name' => 'Halberd', 'attack_type' => 'Melee',
            'max_damage' => 8, 'min_damage' => 1, 'damage_type' => 'sp',
            'range' => 2, 'hit_bonus' => 0, 'attack_effect' => '',
            'properties' => '+1 Range', 'properties_short' => '+1 Range',
            'sprite_id' => 4],

            ['id' => 4, 'name' => 'Battleaxe', 'attack_type' => 'Melee',
            'max_damage' => 12, 'min_damage' => 1, 'damage_type' => 'sb',
            'range' => 1, 'hit_bonus' => 1, 'attack_effect' => '',
            'properties' => '+2 Crit Chance', 'properties_short' => '+2 Crit',
            'sprite_id' => 4],

            ['id' => 5, 'name' => 'Claw', 'attack_type' => 'Melee',
            'max_damage' => 4, 'min_damage' => 2, 'damage_type' => 's',
            'range' => 1, 'hit_bonus' => 1, 'attack_effect' => '',
            'properties' => '+1 Min Damage', 'properties_short' => '',
            'sprite_id' => 3],



            ['id' => 6, 'name' => 'Bodkin', 'attack_type' => 'Ranged',
            'max_damage' => 4, 'min_damage' => 1, 'damage_type' => 'p',
            'range' => 4, 'hit_bonus' => 3, 'attack_effect' => '',
            'properties' => '+3 Accuracy', 'properties_short' => '+3 Acc',
            'sprite_id' => 1],

            ['id' => 7, 'name' => 'Broadhead', 'attack_type' => 'Ranged',
            'max_damage' => 6, 'min_damage' => 2, 'damage_type' => 'p',
            'range' => 4, 'hit_bonus' => 0, 'attack_effect' => '',
            'properties' => '+1 Min Damage', 'properties_short' => '',
            'sprite_id' => 1],

            ['id' => 8, 'name' => 'Poison-Tipped', 'attack_type' => 'Ranged',
            'max_damage' => 4, 'min_damage' => 1, 'damage_type' => 'p',
            'range' => 4, 'hit_bonus' => 0, 'attack_effect' => 'Poisoned',
            'properties' => '50% Poison Chance', 'properties_short' => '50% Poison',
            'sprite_id' => 1],

            ['id' => 9, 'name' => 'Heavy Bolts', 'attack_type' => 'Ranged',
            'max_damage' => 10, 'min_damage' => 4, 'damage_type' => 'b',
            'range' => 3, 'hit_bonus' => 0, 'attack_effect' => '',
            'properties' => '+3 Min Damage, -1 Range', 'properties_short' => '-1 Range',
            'sprite_id' => 1],

            ['id' => 10, 'name' => 'Ancient Nord', 'attack_type' => 'Ranged',
            'max_damage' => 4, 'min_damage' => 2, 'damage_type' => 'p',
            'range' => 4, 'hit_bonus' => 0, 'attack_effect' => '',
            'properties' => '+1 Min Damage', 'properties_short' => '', 'sprite_id' => 1],



            ['id' => 11, 'name' => 'Magic Missile', 'attack_type' => 'Magic',
            'max_damage' => 6, 'min_damage' => 2, 'damage_type' => 'm',
            'range' => 6, 'hit_bonus' => 0, 'attack_effect' => '',
            'properties' => 'Unerring Accuracy', 'properties_short' => '100% Acc',
            'sprite_id' => 0],

            ['id' => 12, 'name' => 'Fireball', 'attack_type' => 'Magic',
            'max_damage' => 4, 'min_damage' => 1, 'damage_type' => 'm',
            'range' => 6, 'hit_bonus' => 0, 'attack_effect' => 'Burned',
            'properties' => '50% Burn Chance', 'properties_short' => '50% Burn',
            'sprite_id' => 5],

            ['id' => 13, 'name' => 'Frostbolt', 'attack_type' => 'Magic',
            'max_damage' => 4, 'min_damage' => 1, 'damage_type' => 'm',
            'range' => 6, 'hit_bonus' => 0, 'attack_effect' => 'Frozen',
            'properties' => '50% Freeze Chance', 'properties_short' => '50% Freeze',
            'sprite_id' => 5],

            ['id' => 14, 'name' => 'Eldritch Blast', 'attack_type' => 'Magic',
            'max_damage' => 10, 'min_damage' => 2, 'damage_type' => 'm',
            'range' => 5, 'hit_bonus' => -2, 'attack_effect' => '',
            'properties' => '-2 Accuracy, +1 Min Damage', 'properties_short' => '-2 Acc',
            'sprite_id' => 0],

            ['id' => 15, 'name' => 'Dragons Breath', 'attack_type' => 'Magic',
            'max_damage' => 25, 'min_damage' => 5, 'damage_type' => 'm',
            'range' => 5, 'hit_bonus' => 0, 'attack_effect' => 'Burned',
            'properties' => "It's fire. From a fucking dragon.", 'properties_short' => '',
            'sprite_id' => 0],
        ];

        Weapon::insert($weapons);
    }
}
