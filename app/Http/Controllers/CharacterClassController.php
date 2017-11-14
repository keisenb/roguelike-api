<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\CharacterClass;


class CharacterClassController extends BaseController
{


    /**
     * @SWG\Get(
     *   path="/classes",
     *   tags={"Classes"},
     *   summary="lists all classes",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with character classes",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/CharacterClass")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no classes in table, or an error."
     *   )
     * )
     */
    public function GetClasses() {
        $classes = CharacterClass::get();
        return $classes;
    }

    /**
     * @SWG\Get(
     *   path="/classes/{id}",
     *   tags={"Classes"},
     *   summary="list character class by id",
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="UUID",
     * 		),
     *   @SWG\Response(
     *     response=200,
     *     description="A character class object",
     *     @SWG\Schema(ref="#/definitions/CharacterClass")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no class w/ id found in table, or an error."
     *   )
     * )
     */
    public function GetClassById($id) {
        return CharacterClass::findOrFail($id);
    }
}
