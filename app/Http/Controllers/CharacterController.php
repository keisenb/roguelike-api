<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Character;
use Illuminate\Http\Request;
use App\Armor;
use App\Weapon;
use App\CharacterClass;

class CharacterController extends BaseController
{

    /**
     * @SWG\Post(
     *   path="/characters",
     *   tags={"Character"},
     *   summary="Creates a new character.",
     *   @SWG\Parameter(
     *       name="character",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/PostCharacter"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
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
     *     description="Unable to find armor, class, or weapon by id.",
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
            'armor_id' => 'required|integer|max:99999999999',
            'class_id' => 'required|integer|max:99999999999'
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

        $class = CharacterClass::where('id', $request->class_id)->first();
        if($class == NULL) {
            $class = "Class not found with id: " . $request->class_id;
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
        $character->class()->associate($class->id);
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
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
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


    /**
     * @SWG\Put(
     *   path="/characters/{id}",
     *   tags={"Character"},
     *   summary="Updates an existing character, all parameters are optional. Pass only what's needed to be updated.",
     *   @SWG\Parameter(
     *       name="character",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/UpdateCharacter"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="The updated character object.",
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
     *     description="Unable to find character for killed_by parameter.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function UpdateCharacter(Request $request, $id) {
        $character = Character::findOrFail($id);

        $this->validate($request, [
            'health' => 'integer|max:99999999999',
            'attack_bonus' => 'integer|max:99999999999',
            'damage_bonus' => 'integer|max:99999999999',
            'defense_bonus' => 'integer|max:99999999999',
            'weapon_id' => 'integer|max:99999999999',
            'armor_id' => 'integer|max:99999999999',
            'killed_by' => 'integer|max:99999999999'
        ]);

        if ($request->has('health')) {
            $character->health = $request->health;
        }
        if ($request->has('attack_bonus')) {
            $character->attack_bonus = $request->attack_bonus;
        }
        if ($request->has('damage_bonus')) {
            $character->damage_bonus = $request->damage_bonus;
        }
        if ($request->has('defense_bonus')) {
            $character->defense_bonus = $request->defense_bonus;
        }
        if ($request->has('weapon_id')) {
            $character->weapon_id = $request->weapon_id;
        }
        if ($request->has('armor_id')) {
            $character->armor_id = $request->armor_id;
        }
        if ($request->has('killed_by')) {
            $killed_by = Character::where('id', $request->killed_by)->first();
            if($killed_by == NULL) {
                $message = "Character not found with killed_by id: " . $request->killed_by;
                return response()->json(['message' => $message ], 404);
            }
            $character->killed()->associate($request->killed_by);
        }

        $character->save();
        return Character::findOrFail($id);
    }

}
