<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Level;


class LevelController extends BaseController
{


    /**
     * @SWG\Get(
     *   path="/levels",
     *   tags={"Levels"},
     *   summary="lists all levels",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ), 
     *   @SWG\Response(
     *     response=200,
     *     description="A list with levels",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/Level")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no levels in table, or an error."
     *   )
     * )
     */
    public function GetLevels() {
        $levels = Level::get();
        return $levels;
    }

    /**
     * @SWG\Get(
     *   path="/levels/{id}",
     *   tags={"Levels"},
     *   summary="returns a level by id",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ), 
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="UUID",
     * 		),
     *   @SWG\Response(
     *     response=200,
     *     description="A level object",
     *     @SWG\Schema(ref="#/definitions/Level")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no level w/ id found in table, or an error."
     *   )
     * )
     */
    public function GetLevelById($id) {
        return Level::findOrFail($id);
    }
}
