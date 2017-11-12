<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerUp extends Model
{
	protected $table = 'power_ups';

    protected $fillable = ['name'];
}
