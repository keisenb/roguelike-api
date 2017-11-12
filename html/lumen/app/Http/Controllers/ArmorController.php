<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Armor;


class ArmorController extends BaseController
{


    /**
     * @SWG\Get(
     *   path="/armors",
     *   tags={"Armors"},
     *   summary="lists all armors",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with armors",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/Armor")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no armors in table, or an error."
     *   )
     * )
     */
    public function GetArmors() {
        $armors = Armor::get();
        return $armors; //response()->json($powerups, 200);  //this also works
    }

    /**
     * @SWG\Get(
     *   path="/armors/{id}",
     *   tags={"Armors"},
     *   summary="list armor by id",
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="UUID",
     * 		),
     *   @SWG\Response(
     *     response=200,
     *     description="A armor object",
     *     @SWG\Schema(ref="#/definitions/Armor")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no armor w/ id found in table, or an error."
     *   )
     * )
     */
    public function GetArmorById($id) {
        return Armor::findOrFail($id);
    }
}
