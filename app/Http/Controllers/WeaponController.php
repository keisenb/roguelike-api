<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Weapon;


class WeaponController extends BaseController
{


    /**
     * @SWG\Get(
     *   path="/weapons",
     *   tags={"Weapons"},
     *   summary="lists all weapons",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with weapons",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/Weapon")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no weapons in table, or an error."
     *   )
     * )
     */
    public function GetWeapons() {
        $weapons = Weapon::get();
        return $weapons;
    }

    /**
     * @SWG\Get(
     *   path="/weapons/{id}",
     *   tags={"Weapons"},
     *   summary="list weapon by id",
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="UUID",
     * 		),
     *   @SWG\Response(
     *     response=200,
     *     description="A weapon object",
     *     @SWG\Schema(ref="#/definitions/Weapon")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no weapon w/ id found in table, or an error."
     *   )
     * )
     */
    public function GetWeaponById($id) {
        return Weapon::findOrFail($id);
    }
}
