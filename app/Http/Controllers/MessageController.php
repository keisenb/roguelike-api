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


}