<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Friend;
use Auth;
use Illuminate\Http\Request;


class FriendController extends BaseController
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
    public function AddFriend($id)
    {

    }

    public function DeleteFriend(Request $request)
    {
        //Friends::where('email2', $id)->delete();
    }

    public function GetFriends()
    {
        //todo add with user to query
        $user = Auth::user();
        $friends = Friend::where('id1', $user->id)
                ->orWhere('id2', $user->id)
                ->with(['user1', 'user2'])
                ->get();
        return $friends;
    }
}
