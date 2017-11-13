<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'users';
	protected $fillable = [
		'email', 'display_name'
	];

	protected $hidden = [
		'password',
	];

}
