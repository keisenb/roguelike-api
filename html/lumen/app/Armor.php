<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
	protected $table = 'armors';

    protected $fillable = [
		'name', 'defense_value', 'strong_type', 'weak_type' ];
}
