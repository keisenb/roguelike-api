<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Message;

class MessageController extends BaseController
{
    /**
     * @SWG\Get(
     *   path="/messages",
     *   tags={"Messages"},
     *   summary="List messages by user",
     *   @SWG\Response(
     *     response=200,
     *     description="A message object",
     *     @SWG\Schema(ref="#/definitions/Message")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="no messages by user found in table, or an error."
     *   )
     * )
     */
    public function GetUserMessages()
    {
        return Message::findOrFail(Auth::user());
    }

    /**
     * @SWG\Post(
     *   path="/message",
     *   tags={"Messages"},
     *   summary="Sends a message.",
     *   @SWG\Parameter(
     *     name="message",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Message"),
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
     *     @SWG\Schema(ref="#definitions/Message")
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
     *   )
     * )
     */
    public function SendMessage(Request $request)
    {
        $this->validate($request, [
            'sender_id'=>'required|integer|max:99999999999',
            'recipient_id'=>'required|integer|max:99999999999',
            'content'=>'required|max:255',
            'created_at'=>'required|max:255',
            'updated_at'=>'required|max:255',
        ]);
        $message = new Message();
        $message->sender_id=$request->sender_id;
        $message->recipient_id=$request->recipient_id;
        $message->content=$request->content;
        $message->created_at=$request->created_at;
        $message->updated_at=$request->updated_at;
        $message->save();
        return Message::findOrFail($message->id);
    }
}