<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Character;
use Illuminate\Http\Request;
use App\Armor;
use App\Weapon;

class CharacterController extends BaseController
{

    /**
     * @SWG\Post(
     *   path="/characters/create",
     *   tags={"Character"},
     *   summary="Creates a new character.",
     *   @SWG\Parameter(
     *       name="character",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/PostCharacter"),
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="The created character object.",
     *     @SWG\Schema(ref="#/definitions/Character")
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
     *     description="Unable to find armor or weapon by id.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function CreateCharacter(Request $request) {

        $this->validate($request, [
            'name'    => 'required|max:255',
            'health' => 'required|integer|max:99999999999',
            'attack_bonus' => 'required|integer|max:99999999999',
            'damage_bonus' => 'required|integer|max:99999999999',
            'defense_bonus' => 'required|integer|max:99999999999',
            'weapon_id' => 'required|integer|max:99999999999',
            'armor_id' => 'required|integer|max:99999999999'
        ]);

        $armor = Armor::where('id', $request->armor_id)->first();
        if($armor == NULL) {
            $message = "Armor not found with id: " . $request->armor_id;
            return response()->json(['message' => $message ], 404);
        }

        $weapon = Weapon::where('id', $request->weapon_id)->first();
        if($weapon == NULL) {
            $message = "Weapon not found with id: " . $request->weapon_id;
            return response()->json(['message' => $message ], 404);
        }

        $character = new Character();
        $character->name = $request->name;
        $character->health = $request->health;
        $character->attack_bonus = $request->attack_bonus;
        $character->damage_bonus = $request->damage_bonus;
        $character->defense_bonus = $request->defense_bonus;
        $character->weapon()->associate($weapon->id);
        $character->armor()->associate($armor->id);
        $character->save();

        return Character::findOrFail($character->id);
    }


    /**
     * @SWG\Get(
     *   path="/characters/{id}",
     *   tags={"Character"},
     *   summary="return character by id",
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="UUID",
     * 		),
     *   @SWG\Response(
     *     response=200,
     *     description="A character object",
     *     @SWG\Schema(ref="#/definitions/Character")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no character w/ id found in table, or an error."
     *   )
     * )
     */
    public function GetCharacterById($id) {
        return Character::findOrFail($id);
    }

    public function UpdateCharacter(Request $request) {
        return $request->all();
    }

}
