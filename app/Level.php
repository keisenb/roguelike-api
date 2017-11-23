<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
	protected $table = 'levels';

    protected $fillable = [
		'user_id', 'seed', 'number' ];


	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}
}
