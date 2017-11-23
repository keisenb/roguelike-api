<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Friend;
use Auth;
use Illuminate\Http\Request;
use App\User;

class FriendController extends BaseController
{




    /**
     * @SWG\Post(
     *   path="/friends",
     *   tags={"Friends"},
     *   summary="Adds a friend by username.",
     *   @SWG\Parameter(
     *       name="friend",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/AddFriend"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="Added friend.",
     *     @SWG\Schema(ref="#/definitions/Friend")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=400,
     *     description="Already friends with user.",
     *     @SWG\Schema(@SWG\Property(property="parameter_name", type ="string", default="error message"))
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="Unable to find friend by username",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function AddFriend(Request $request)
    {
        $this->validate($request, [
            'display_name'    => 'required|max:255'
        ]);
        $user = Auth::user();
        $friend = User::where('display_name', $request->display_name)->first();

        if($friend == NULL) {
            $message = "Unable to find user with display name: " . $request->display_name;
            return response()->json(['message' => $message ], 404);
        }

        if(Friend::where('id1', $user->id)->where('id2', $friend->id)->first()) {
            $message = "You're already friends with: " . $request->display_name;
            return response()->json(['message' => $message ], 400);
        }

        if(Friend::where('id2', $user->id)->where('id1', $friend->id)->first()) {
            $message = "You're already friends with: " . $request->display_name;
            return response()->json(['message' => $message ], 400);
        }

        $friends = new Friend();
        $friends->user1()->associate($user->id);
        $friends->user2()->associate($friend->id);
        $friends->save();

        return Friend::where('id1', $user->id)->where('id2', $friend->id)->with(['user1', 'user2'])->first();
    }



    /**
     * @SWG\Delete(
     *   path="/friends",
     *   tags={"Friends"},
     *   summary="Deletes a friend by username.",
     *   @SWG\Parameter(
     *       name="friend",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/AddFriend"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=204,
     *     description="successfully deleted friend.",
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="Unable to find friend by username.",
     *     @SWG\Schema(@SWG\Property(property="parameter_name", type ="string", default="error message"))
     *   ),
     *   @SWG\Response(
     *     response=400,
     *     description="Not friends with user with the display name.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function DeleteFriend(Request $request)
    {
        $this->validate($request, [
            'display_name'    => 'required|max:255'
        ]);

        $user = Auth::user();
        $friend = User::where('display_name', $request->display_name)->first();

        if($friend == NULL) {
            $message = "Unable to find user with display name: " . $request->display_name;
            return response()->json(['message' => $message ], 404);
        }

        if(Friend::where('id2', $friend->id)->where('id1', $user->id)->delete()) {
            $message = "Deleted friend : " . $request->display_name; //this doesn't actually return cause 204
            return response()->json(['message' => $message], 204);
        }

        if(Friend::where('id1', $friend->id)->where('id2', $user->id)->delete()) {
            $message = "Deleted friend : " . $request->display_name; //this doesn't actually return cause 204
            return response()->json(['message' => $message], 204);
        }

        $message = "Error you are not friends with: " . $request->display_name;
        return response()->json(['message' => $message], 400);

    }



    /**
     * @SWG\Get(
     *   path="/friends",
     *   tags={"Friends"},
     *   summary="lists all friends for current user",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="A list with friends",
     *     @SWG\Schema(
     *          type="array",
     *          @SWG\Items(ref="#/definitions/Friend")
     *      )
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no friends in table, or an error."
     *   )
     * )
     */
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
