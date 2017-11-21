<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Friends;


class FriendsController extends BaseController
{

    /**
     * @SWG\Post(
     *   path="/friends",
     *   tags={"Friends"},
     *   summary="Adds a friend.",
     *   @SWG\Parameter(
     *       name="friendid",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/"),
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="",
     *     @SWG\Schema(ref="#/definitions/")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     */
    public function Add($id)
    {
        
    }

    public function Delete($id)
    {
        Friends->where('email2', '=', $id)->delete();
    }

    public function Get($id)
    {
        return Friends::findOrFail($id);
    }
}
