<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Weapon;
use App\Armor;
use App\CharacterClass;

class ClassItem extends Model
{
    protected $table = 'character_can_equip_inventory_item';

    protected $fillable = [
        'character_class_id', 'item_id'
    ];

    public function class()
    {
		return $this->belongsTo('App\CharacterClass', 'character_class_id');
    }
    
    public function item()
    {
        // hmm?
        // pickup items can only be weapon/armors
        // obv this won't work as is...
        return $this->belongsTo('App\Weapon', 'item_id') || 
               $this->belongsTo('App\Armor', 'item_id');
    }
}