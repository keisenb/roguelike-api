<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Friend;
use Auth;
use Illuminate\Http\Request;
use App\User;

class FriendController extends BaseController
{


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
