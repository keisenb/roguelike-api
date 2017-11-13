<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Armor;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="104.236.217.199",
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
 *  )
 */
class SwaggerController extends BaseController
{

}
