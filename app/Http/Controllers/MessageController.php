<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Message;
use App\User;
use App\Friend;
use Auth;
use Illuminate\Http\Request;


class MessageController extends BaseController
{
    /**
     * @SWG\Get(
     *   path="/messages",
     *   tags={"Messages"},
     *   summary="List messages by user",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="A message object",
     *     @SWG\Schema(ref="#/definitions/Message")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no messages by user found in table, or an error.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function GetUserMessages()
    {
        //so get doesn't take any parameters, you'll have to use a where recipient_id = user id.
        //you also need to only get new messages otherwise this will return all old messages
        //so we just add another column to the table (a boolean) that tells if the message is read or not, 0 is false in mysql
        $user = Auth::user();

        //this might not be neccesary but just in case.
        if($user == NULL) {
            $message = "Issue retrieving user details.";
            return response()->json(['message' => $message ], 404);
        }

        $messages = Message::where('recipient_id', $user->id)->where('read', 0)->get();

        //mark messages as read
        foreach($messages as $message) {
            $message->read = 1;
            $message->save();
        }

        return $messages;

    }

    /**
     * @SWG\Post(
     *   path="/messages",
     *   tags={"Messages"},
     *   summary="Sends a message.",
     *   @SWG\Parameter(
     *     name="message",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/NewMessage"),
     *   ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="Sent message.",
     *     @SWG\Schema(ref="#/definitions/Message")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=422,
     *     description="Unprocessable Entity, missing parameter, invalid parameter.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="unable to find user or friend entities.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function SendMessage(Request $request)
    {
        //should use username so that frontend doesn't have to keep track of id's
        $this->validate($request, [
            'display_name'=>'required|max:255',
            'content'=>'required|max:255'
        ]);

        //check to make sure sender and recipient exist
        $user = Auth::user();
        $friend = User::where('display_name', $request->display_name)->first();

        if($user == NULL) {
            $message = "Issue retrieving user details.";
            return response()->json(['message' => $message ], 404);
        }

        if($friend == NULL) {
            $message = "Issue retrieving friend details for: " . $request->display_name;
            return response()->json(['message' => $message ], 404);
        }

        //need to check if user and friend are actually friends
        if(!Friend::where('id1', $user->id)->where('id2', $friend->id)->first() && !Friend::where('id2', $user->id)->where('id1', $friend->id)->first()) {
            $message = "You are not friends with: " . $friend->display_name;
            return response()->json(['message' => $message ], 404);
        }



        $message = new Message();
        //need to do the FK association in case it doesn't work this is safe
        $message->sender()->associate($user->id);
        $message->recipient()->associate($friend->id);
        $message->content=$request->content;
        $message->save();
        return Message::findOrFail($message->id);
    }
}
