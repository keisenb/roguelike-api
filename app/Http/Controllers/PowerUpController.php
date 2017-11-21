<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\PowerUp;
use Illuminate\Http\Request;
use App\Character;
use App\PickedUpPowerUp;

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


    /**
     * @SWG\Post(
     *   path="/powerups",
     *   tags={"Power Ups"},
     *   summary="Creates a PickedUpPowerUp object.",
     *   @SWG\Parameter(
     *       name="PickedUpPowerUp",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/PickedUpPowerUp"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="The created PickedUpPowerUp object.",
     *     @SWG\Schema(ref="#/definitions/CreatedPickedUpPowerUp")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=422,
     *     description="Unprocessable Entity, missing parameter, invalid parameter.",
     *     @SWG\Schema(@SWG\Property(property="parameter_name", type ="string", default="error message"))
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="Unable to find character or power up by id.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function PickedUpPowerUp(Request $request) {
        $this->validate($request, [
            'character_id'    => 'required|integer|max:99999999999',
            'power_up_id' => 'required|integer|max:99999999999'
        ]);

        $character = Character::where('id', $request->character_id)->first();
        if($character == NULL) {
            $message = "Character not found with id: " . $request->character_id;
            return response()->json(['message' => $message ], 404);
        }

        $powerup = PowerUp::where('id', $request->power_up_id)->first();
        if($powerup == NULL) {
            $message = "Power Up not found with id: " . $request->power_up_id;
            return response()->json(['message' => $message ], 404);
        }

        $pickedup = new PickedUpPowerUp();
        $pickedup->character()->associate($character->id);
        $pickedup->powerup()->associate($powerup->id);
        $pickedup->save();


        return PickedUpPowerUp::findOrFail($pickedup->id);
    }
}
