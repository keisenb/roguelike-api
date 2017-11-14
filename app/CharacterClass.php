<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CharacterClass extends Model
{
	protected $table = 'character_class';

    protected $fillable = [
		'name', 'starting_health', 'starting_attack_bonus', 'starting_damage_bonus',
		'starting_defense_bonus', 'starting_armor', 'starting_weapon', 'options'
	];
}
