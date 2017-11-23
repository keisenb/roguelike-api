<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;
use Auth;
use Illuminate\Http\Request;


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


    /**
     * @SWG\Put(
     *   path="/user",
     *   tags={"User"},
     *   summary="Updates the current auth'd user. All parameters are optional. Pass only what's needed to be updated.",
     *   @SWG\Parameter(
     *       name="user",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(ref="#/definitions/UpdateUser"),
     *	 ),
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="The updated user object.",
     *     @SWG\Schema(ref="#/definitions/User")
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
     *   ),
     *   @SWG\Response(
     *     response=409,
     *     description="Conflict with display name or email.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string", default="error message"))
     *   )
     * )
     */
    public function UpdateUser(Request $request) {
        $user = Auth::user();

        $this->validate($request, [
            'email' => 'email|max:255',
            'display_name' => 'max:255',
            'password' => 'confirmed|max:255',
            'password_confirmation' => 'max:255',
        ]);


        if ($request->has('email')) {
            if(User::where('email', $request->email)->first() && $user->email != $request->email) {
                $message = "User account already exists with email: " . $request->email;
                return response()->json(['message' => $message ], 409);
            }
            $user->email = $request->email;
        }
        if ($request->has('display_name')) {
            if(User::where('display_name', $request->display_name)->first() && $user->display_name != $request->display_name) {
                $message = "User account already exists with display name: " . $request->display_name;
                return response()->json(['message' => $message ], 409);
            }
            $user->display_name = $request->display_name;
        }
        if ($request->has('password')) {
            $user->password = app('hash')->make($request->password);
        }

        $user->save();
        return Auth::user();
    }

}
