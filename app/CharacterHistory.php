<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterHistory extends Model
{
	protected $table = 'character_history';

    protected $fillable = [
		'user_id', 'character_id', 'score', 'level_id' ];


	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}

	public function character() {
		return $this->belongsTo('App\CharacterClass', 'character_id');
	}

	public function level() {
		return $this->belongsTo('App\Level', 'level_id');
	}
}
