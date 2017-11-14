<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;
use Auth;


class UserController extends BaseController
{

    /**
     * @SWG\Get(
     *   path="/user",
     *   tags={"User"},
     *   summary="Returns authenticated user",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="A user object",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/User")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="not authenticated."
     *   )
     * )
     */
    public function GetUser() {
        return Auth::user();
    }

}
