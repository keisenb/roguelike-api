<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickedUpPowerUp extends Model
{
	protected $table = 'character_picked_up_powerup';

    protected $fillable = [
		'character_class_id', 'power_up_id', 'created_at', 'updated_at'];

	public function character() {
		return $this->belongsTo('App\Character', 'character_id');
	}

	public function powerup() {
		return $this->belongsTo('App\PowerUp', 'power_up_id');
	}

}
