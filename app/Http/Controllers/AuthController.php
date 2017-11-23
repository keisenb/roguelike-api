<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Auth;
use App\User;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @SWG\Get(
     *   path="/test",
     *   tags={"Auth"},
     *   summary="Test Auth method",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="Returns Hello World if token is correct.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   )
     * )
     */


    /**
     * @SWG\Post(
     *   path="/login",
     *   tags={"Auth"},
     *   summary="Authenticates a User",
     *   @SWG\Parameter(
     *       name="email",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(
     *          @SWG\Property(property="email", type="string"),
     *
     *       ),
     *	 ),
     *   @SWG\Parameter(
     *       name="password",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(
     *          @SWG\Property(property="password", type="string"),
     *
     *       ),
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="A bearer token to authenticate with.",
     *     @SWG\Schema(ref="#/definitions/LoginResponse")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="User not found.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   )
     * )
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['message' => 'user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        return response()->json(compact('token'));
    }


    /**
     * @SWG\Get(
     *   path="/logout",
     *   tags={"Auth"},
     *   summary="Logs a User out.",
     *   @SWG\Parameter(
     *       name="token",
     * 		 in="header",
     * 		 required=true,
     *       type="string"
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="Returns string status of logout attempt.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   )
     * )
     */
    public function logout()
    {
        $this->jwt->invalidate($this->jwt->getToken());

        return response()->json(['message' => 'logged out'], 200);
    }


    /**
     * @SWG\Post(
     *   path="/register",
     *   tags={"Auth"},
     *   summary="Registers a User",
     *   @SWG\Parameter(
     *       name="registration",
     * 		 in="body",
     * 		 required=true,
     * 		 @SWG\Schema(
     *          @SWG\Property(property="email", type="string"),
     *          @SWG\Property(property="display_name", type="string"),
     *          @SWG\Property(property="password", type="string"),
     *          @SWG\Property(property="password_confirmation", type="string"),
     *       ),
     *	 ),
     *   @SWG\Response(
     *     response=200,
     *     description="A bearer token to authenticate with.",
     *     @SWG\Schema(ref="#/definitions/LoginResponse")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="unauthorized, invalid token, missing token, expired token.",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   ),
     *   @SWG\Response(
     *     response=409,
     *     description="User already exists (email or display_name conflict).",
     *     @SWG\Schema(@SWG\Property(property="message", type ="string"))
     *   )
     * )
     */
    public function register(Request $request) {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required|confirmed|max:255',
            'password_confirmation' => 'required|max:255',
            'display_name' => 'required|max:255',
        ]);

        if(User::where('email', $request->email)->first()) {
            $message = "User account already exists with email: " . $request->email;
            return response()->json(['message' => $message ], 409);
        }

        if(User::where('display_name', $request->display_name)->first()) {
            $message = "User account already exists with display name: " . $request->display_name;
            return response()->json(['message' => $message ], 409);
        }

        $user = new User;
        $user->email = $request->email;
        $user->display_name = $request->display_name;
        $user->password = app('hash')->make($request->password);//bcrypt('password');
        $user->save();

        try {
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['message' => 'user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        return response()->json(compact('token'));
    }

}
