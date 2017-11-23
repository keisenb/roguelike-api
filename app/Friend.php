<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
	protected $table = 'friends';
	public $timestamps = false;


    protected $fillable = [
        'id1', 'id2'
    ];

	public function user1() {
		return $this->belongsTo('App\User', 'id1');
	}

	public function user2() {
		return $this->belongsTo('App\User', 'id2');
	}
}
