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
 *                  @SWG\Property(property="strong_type", type="integer"),
 *                  @SWG\Property(property="weak_type", type="integer")
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
 *
 *  )
 */
class SwaggerController extends BaseController
{

}
