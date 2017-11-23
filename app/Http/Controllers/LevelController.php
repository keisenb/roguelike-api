<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Level;
use Auth;
use Illuminate\Http\Request;


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
        $levels = Level::with('user')->get();
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


    /**
     * @SWG\Post(
     *   path="/levels",
     *   tags={"Levels"},
     *   summary="Creates a new level.",
     *   @SWG\Parameter(
     *       name="level",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/CreateLevel"),
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="The created character object.",
     *     @SWG\Schema(ref="#/definitions/NewLevel")
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
     *   )
     * )
     */
    public function CreateLevel(Request $request) {
        $this->validate($request, [
            'seed'    => 'required|max:255',
            'number'  => 'required|max:99999999999'
        ]);

        $user = Auth::user();

        $level = new Level();
        $level->user()->associate($user->id);
        $level->seed = $request->seed;
        $level->number = $request->number;
        $level->save();

        return Level::findOrFail($level->id);
    }


}
