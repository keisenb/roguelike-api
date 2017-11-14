<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
	protected $table = 'weapons';

    protected $fillable = [
		'name', 'attack_type', 'max_damage', 'min_damage', 'damage_type',
	 	'range', 'hit_bonus', 'attack_effect', 'properties', 'properties_short',
		'sprite_id'];
}
