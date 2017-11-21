<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
	protected $table = 'characters';

    protected $fillable = [
		'name', 'health', 'attack_bonus', 'damage_bonus', 'defense_bonus',
	 	'weapon_id', 'armor_id', 'killed_by'];

	public function weapon() {
		return $this->belongsTo('App\Weapon', 'weapon_id');
	}

	public function armor() {
		return $this->belongsTo('App\Armor', 'armor_id');
	}
}
