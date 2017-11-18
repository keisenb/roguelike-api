<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\CharacterHistory;

class CharacterHistoryController extends BaseController
{


    /**
     * @SWG\Get(
     *   path="/characters/history",
     *   tags={"Character History"},
     *   summary="lists all character histories",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with character histories",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/CharacterHistory")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no character histories in table, or an error."
     *   )
     * )
     */
    public function GetCharacterHistories() {
        $histories = CharacterHistory::with(['character', 'level'])->get();
        return $histories;
    }

    /**
     * @SWG\Get(
     *   path="/characters/history/{id}",
     *   tags={"Character History"},
     *   summary="list character history by id",
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="UUID",
     * 		),
     *   @SWG\Response(
     *     response=200,
     *     description="A character history object",
     *     @SWG\Schema(ref="#/definitions/CharacterHistory")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no character history w/ id found in table, or an error."
     *   )
     * )
     */
    public function GetCharacterHistory($id) {
        return CharacterHistory::with('character', 'level')->findOrFail($id);
    }
}
