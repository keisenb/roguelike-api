<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\PowerUp;

class PowerUpController extends BaseController
{

    public function GetPowerUps() {
        $powerups = PowerUp::get();
        return $powerups; //response()->json($powerups, 200);  //this also works
    }

    public function GetPowerUp($id) {
        return PowerUp::findOrFail($id);
    }
}
