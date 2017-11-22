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
     *   summary="list message by userid",
     *   @SWG\Response(
     *     response=200,
     *     description="A weapon object",
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