<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Armor;

/**
 * @SWG\Swagger(
 *     schemes={"https"},
 *     host="rogueapi.keisenb.io",
 *     basePath="/api",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Roguelike API",
 *         description="Api documentation for roguelike game.",
 *         termsOfService=""
 *     ),
 *
 *      @SWG\Definition(
 *          definition="PowerUp",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="name", type="string")
 *              )
 *          }
 *      ),
 *
 *      @SWG\Definition(
 *          definition="Armor",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="name", type="string"),
 *                  @SWG\Property(property="defense_value", type="integer"),
 *                  @SWG\Property(property="strong_type", type="string"),
 *                  @SWG\Property(property="weak_type", type="string")
 *              )
 *          }
 *      ),
 *       @SWG\Definition(
 *          definition="CharacterClass",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="name", type="string"),
 *                  @SWG\Property(property="starting_health", type="integer"),
 *                  @SWG\Property(property="starting_attack_bonus", type="integer"),
 *                  @SWG\Property(property="starting_damage_bonus", type="integer"),
 *                  @SWG\Property(property="starting_defense_bonus", type="integer"),
 *                  @SWG\Property(property="starting_armor", type="integer"),
 *                  @SWG\Property(property="starting_weapon", type="integer"),
 *                  @SWG\Property(property="options", type="string")
 *              )
 *          }
 *      ),
 *
 *
 *       @SWG\Definition(
 *          definition="Weapon",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="name", type="string"),
 *                  @SWG\Property(property="attack_type", type="integer"),
 *                  @SWG\Property(property="max_damage", type="integer"),
 *                  @SWG\Property(property="min_damage", type="integer"),
 *                  @SWG\Property(property="damage_type", type="integer"),
 *                  @SWG\Property(property="range", type="integer"),
 *                  @SWG\Property(property="hit_bonus", type="integer"),
 *                  @SWG\Property(property="attack_effect", type="string"),
 *                  @SWG\Property(property="properties", type="string"),
 *                  @SWG\Property(property="properties_short", type="string"),
 *                  @SWG\Property(property="sprite_id", type="integer")
 *              )
 *          }
 *      ),
 *       @SWG\Definition(
 *          definition="LoginResponse",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="token", type="string"),
 *              )
 *          }
 *      ),
 *
 *       @SWG\Definition(
 *          definition="User",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="email", type="string"),
 *                  @SWG\Property(property="display_name", type="string"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *              )
 *          }
*        ),
 *       @SWG\Definition(
 *          definition="CharacterHistory",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="user_id", type="integer"),
 *                  @SWG\Property(property="character_id", type="integer"),
 *                  @SWG\Property(property="score", type="integer"),
 *                  @SWG\Property(property="level_id", type="integer"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *                  @SWG\Property(property="character", type="object",
 *                      @SWG\Property(property="id", type="integer"),
 *                      @SWG\Property(property="name", type="string"),
 *                      @SWG\Property(property="attack_bonus", type="integer"),
 *                      @SWG\Property(property="damage_bonus", type="integer"),
 *                      @SWG\Property(property="defense_bonus", type="integer"),
 *                      @SWG\Property(property="weapon_id", type="integer"),
 *                      @SWG\Property(property="armor_id", type="integer"),
 *                      @SWG\Property(property="class_id", type="integer"),
 *                      @SWG\Property(property="created_at", type="string"),
 *                      @SWG\Property(property="updated_at", type="string"),
 *                      @SWG\Property(property="killed_by", type="integer"),
 *                      @SWG\Property(property="class", type="object",
 *                          @SWG\Property(property="id", type="integer"),
 *                          @SWG\Property(property="name", type="string"),
 *                          @SWG\Property(property="starting_health", type="integer"),
 *                          @SWG\Property(property="starting_attack_bonus", type="integer"),
 *                          @SWG\Property(property="starting_damage_bonus", type="integer"),
 *                          @SWG\Property(property="starting_defense_bonus", type="integer"),
 *                          @SWG\Property(property="starting_weapon", type="integer"),
 *                          @SWG\Property(property="starting_armor", type="integer"),
 *                          @SWG\Property(property="options", type="string"),)
 *                  ),
 *                  @SWG\Property(property="killed", type="object",
 *                      @SWG\Property(property="id", type="integer"),
 *                      @SWG\Property(property="name", type="string"),
 *                      @SWG\Property(property="attack_bonus", type="integer"),
 *                      @SWG\Property(property="damage_bonus", type="integer"),
 *                      @SWG\Property(property="defense_bonus", type="integer"),
 *                      @SWG\Property(property="weapon_id", type="integer"),
 *                      @SWG\Property(property="armor_id", type="integer"),
 *                      @SWG\Property(property="class_id", type="integer"),
 *                      @SWG\Property(property="created_at", type="string"),
 *                      @SWG\Property(property="updated_at", type="string"),
 *                      @SWG\Property(property="killed_by", type="integer"),
 *                  ),
 *                  @SWG\Property(property="level", type="object",
 *                      @SWG\Property(property="id", type="integer"),
 *                      @SWG\Property(property="user_id", type="integer"),
 *                      @SWG\Property(property="seed", type="string"),
 *                      @SWG\Property(property="number", type="integer"),
 *                      @SWG\Property(property="created_at", type="string"),
 *                      @SWG\Property(property="updated_at", type="string"),
 *                  )
 *
 *
 *              )
 *          }
*        ),
 *      @SWG\Definition(
 *          definition="Level",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="user_id", type="string"),
 *                  @SWG\Property(property="seed", type="string"),
 *                  @SWG\Property(property="number", type="integer"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *                  @SWG\Property(property="user", type="object",
 *                      @SWG\Property(property="id", type="integer"),
 *                      @SWG\Property(property="email", type="string"),
 *                      @SWG\Property(property="display_name", type="string"),
 *                      @SWG\Property(property="created_at", type="string"),
 *                      @SWG\Property(property="updated_at", type="string"),
 *                  ), *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="PostCharacter",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="name", type="string"),
 *                  @SWG\Property(property="health", type="integer"),
 *                  @SWG\Property(property="attack_bonus", type="integer"),
 *                  @SWG\Property(property="damage_bonus", type="integer"),
 *                  @SWG\Property(property="defense_bonus", type="integer"),
 *                  @SWG\Property(property="weapon_id", type="integer"),
 *                  @SWG\Property(property="armor_id", type="integer"),
 *                  @SWG\Property(property="class_id", type="integer"),
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="Character",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="name", type="string"),
 *                  @SWG\Property(property="health", type="integer"),
 *                  @SWG\Property(property="attack_bonus", type="integer"),
 *                  @SWG\Property(property="damage_bonus", type="integer"),
 *                  @SWG\Property(property="defense_bonus", type="integer"),
 *                  @SWG\Property(property="weapon_id", type="integer"),
 *                  @SWG\Property(property="armor_id", type="integer"),
 *                  @SWG\Property(property="class_id", type="integer"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *                  @SWG\Property(property="killed_by", type="integer"),
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="UpdateCharacter",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="health", type="integer"),
 *                  @SWG\Property(property="attack_bonus", type="integer"),
 *                  @SWG\Property(property="damage_bonus", type="integer"),
 *                  @SWG\Property(property="defense_bonus", type="integer"),
 *                  @SWG\Property(property="weapon_id", type="integer"),
 *                  @SWG\Property(property="armor_id", type="integer"),
 *                  @SWG\Property(property="killed_by", type="integer"),
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="CreateLevel",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="seed", type="string"),
 *                  @SWG\Property(property="number", type="integer")
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="NewLevel",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="user_id", type="integer"),
 *                  @SWG\Property(property="seed", type="string"),
 *                  @SWG\Property(property="number", type="integer"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="PostCharacterHistory",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="character_id", type="integer"),
 *                  @SWG\Property(property="level_id", type="integer"),
 *                  @SWG\Property(property="score", type="integer")
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="NewCharacterHistory",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="user_id", type="integer"),
 *                  @SWG\Property(property="character_id", type="integer"),
 *                  @SWG\Property(property="score", type="integer"),
 *                  @SWG\Property(property="level_id", type="integer"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="PickedUpPowerUp",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="character_id", type="integer"),
 *                  @SWG\Property(property="power_up_id", type="integer")
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="CreatedPickedUpPowerUp",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id", type="integer"),
 *                  @SWG\Property(property="character_id", type="integer"),
 *                  @SWG\Property(property="power_up_id", type="integer"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="AddFriend",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="display_name", type="string")
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="Message",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="sender_id", type="integer"),
 *                  @SWG\Property(property="recipient_id", type="integer"),
 *                  @SWG\Property(property="content", type="string"),
 *                  @SWG\Property(property="created_at", type="string"),
 *                  @SWG\Property(property="updated_at", type="string"),
 *                  @SWG\Property(property="display_name", type="string")
 *              )
 *          }
 *      ),
 *      @SWG\Definition(
 *          definition="NewMessage",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="display_name", type="string"),
 *                  @SWG\Property(property="content", type="string"),
 *              )
 *          }
 *      ),
 *       @SWG\Definition(
 *          definition="Friend",
 *          type="object",
 *          allOf={
 *              @SWG\Schema(
 *                  @SWG\Property(property="id1", type="integer"),
 *                  @SWG\Property(property="id2", type="integer"),
 *                  @SWG\Property(property="user1", type="object",
 *                      @SWG\Property(property="id", type="integer"),
 *                      @SWG\Property(property="name", type="string"),
 *                  ),
 *                  @SWG\Property(property="user2", type="object",
 *                      @SWG\Property(property="id", type="integer"),
 *                      @SWG\Property(property="name", type="string")
 *              ))
 *          }
*        ),
*      @SWG\Definition(
*          definition="UpdateCharacterHistory",
*          type="object",
*          allOf={
*              @SWG\Schema(
*                  @SWG\Property(property="score", type="integer"),
*                  @SWG\Property(property="level_id", type="integer")
*              )
*          }
*      ),
*      @SWG\Definition(
*          definition="UpdateUser",
*          type="object",
*          allOf={
*              @SWG\Schema(
*                  @SWG\Property(property="email", type="string"),
*                  @SWG\Property(property="display_name", type="string"),
*                  @SWG\Property(property="password", type="string"),
*                  @SWG\Property(property="password_confirmation", type="string"),
*              )
*          }
*      ),
 *  )
 */

class SwaggerController extends BaseController
{

}
