<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\PowerUp;

class PowerUpController extends BaseController
{


    /**
     * @SWG\Get(
     *   path="/powerups",
     *   tags={"Power Ups"},
     *   summary="lists all powerups",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with powerups",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/PowerUp")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no powerups in table, or an error."
     *   )
     * )
     */
    public function GetPowerUps() {
        $powerups = PowerUp::get();
        return $powerups; //response()->json($powerups, 200);  //this also works
    }

    /**
     * @SWG\Get(
     *   path="/powerups/{id}",
     *   tags={"Power Ups"},
     *   summary="list powerup by id",
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="UUID",
     * 		),
     *   @SWG\Response(
     *     response=200,
     *     description="A powerup object",
     *     @SWG\Schema(ref="#/definitions/PowerUp")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no powerup w/ id found in table, or an error."
     *   )
     * )
     */
    public function GetPowerUp($id) {
        return PowerUp::findOrFail($id);
    }
}
