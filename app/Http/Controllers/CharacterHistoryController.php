<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\CharacterHistory;
use Illuminate\Http\Request;
use Auth;
use App\Level;
use App\Character;

class CharacterHistoryController extends BaseController
{


    /**
     * @SWG\Get(
     *   path="/characters/history",
     *   tags={"Character History"},
     *   summary="lists all character histories",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
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
        $user = Auth::user();
        if($user == NULL) {
            $message = "user not found.";
            return response()->json(['message' => $message ], 404);
        }
        $histories = CharacterHistory::with(['character.class', 'level', 'character.killed'])->where('user_id', $user->id)->get();
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
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
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
    public function GetCharacterHistoryById($id) {
        $user = Auth::user();
        if($user == NULL) {
            $message = "user not found.";
            return response()->json(['message' => $message ], 404);
        }
        return CharacterHistory::with('character.class', 'level', 'character.killed')->where('user_id', $user->id)->findOrFail($id);
    }


    /**
     * @SWG\Post(
     *   path="/characters/history",
     *   tags={"Character History"},
     *   summary="Creates a new character.",
     *   @SWG\Parameter(
     *       name="character_history",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/PostCharacterHistory"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="The created character history object.",
     *     @SWG\Schema(ref="#/definitions/NewCharacterHistory")
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
     *     description="Unable to find character or level by id.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function CreateCharacterHistory(Request $request) {

        $this->validate($request, [
            'character_id'    => 'required|integer|max:99999999999',
            'score' => 'required|integer|max:99999999999',
            'level_id' => 'required|integer|max:99999999999'
        ]);

        $user = Auth::user();

        $level = Level::where('id', $request->level_id)->first();
        if($level == NULL) {
            $message = "Level not found with id: " . $request->level_id;
            return response()->json(['message' => $message ], 404);
        }

        $character = Character::where('id', $request->character_id)->first();
        if($character == NULL) {
            $message = "Character not found with id: " . $request->character_id;
            return response()->json(['message' => $message ], 404);
        }

        $history = new CharacterHistory();
        $history->user()->associate($user->id);
        $history->level()->associate($level->id);
        $history->character()->associate($character->id);
        $history->score = $request->score;
        $history->save();

        return CharacterHistory::findOrFail($history->id);

    }


    /**
     * @SWG\Put(
     *   path="/characters/history/{id}",
     *   tags={"Character History"},
     *   summary="Updates an existing character history, all parameters are optional. Pass only what's needed to be updated.",
     *   @SWG\Parameter(
     *       name="history",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/UpdateCharacterHistory"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="The updated character history object.",
     *     @SWG\Schema(ref="#/definitions/NewCharacterHistory")
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
     *     description="Unable to find character history .",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function UpdateCharacterHistory(Request $request, $id) {
        $history = CharacterHistory::findOrFail($id);

        $this->validate($request, [
            'score' => 'integer|max:99999999999',
            'level_id' => 'integer|max:99999999999'
        ]);

        if ($request->has('score')) {
            $history->score = $request->score;
        }
        if ($request->has('level_id')) {
            $level = Level::findOrFail($request->level_id);
            $history->level()->associate($level->id);
        }
        $history->save();
        return CharacterHistory::findOrFail($history->id);

    }

}
