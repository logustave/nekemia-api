<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * @OA\Post(
     * path="/authenticate",
     * operationId="loginApi",
     * tags={"OAuth"},
     * summary="Authentification",
     * description="OAuthLogin",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *          @OA\Property(property="email", example="email"),
     *          @OA\Property(property="password", example="password"),
     *     ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Connexion Réussie",
     *       ),
     * )
     */

    public function authenticate(Request $request): JsonResponse
    {
        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        if ( !Auth::attempt( $login , true)){
            return response()->json(
                array("message"=>'Invalid Login Credentials')
            );
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        Session::flush();
        Auth::logout();
        return response()->json(["token"=>$accessToken],200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }


    /**
     * @OA\Post(
     *     path="/register",
     *     operationId="Inscription",
     *     tags={"OAuth"},
     *     summary="Inscription de l'utilisateur",
     *     description="Informations de l'utilisateurs",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *               @OA\Property(property="name"),
     *               @OA\Property(property="email"),
     *               @OA\Property(property="password"),
     *            ),
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Opération Réussie",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Inscription réussie",
     *       ),
     * )
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        $accessToken =$user->createToken('authToken')->accessToken;
        return response()->json(
            ["user"=>$user,"access_token"=>$accessToken]
        );
    }
}
