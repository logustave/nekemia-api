<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Documentation des APIs de Nekiema BTP",
 *      description="Implementation avec Swagger par Asher Services",
 *      @OA\Contact(
 *          email="mianahissan@protonmail.com"
 *      ),
 *      @OA\License(
 *          name="Nekiema Protected",
 *          url="https://www.nekiema.com"
 *      )
 * )
 *  @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Nekiema Service Server"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $format = JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

    public function cryptRequest($object): string {
        return Crypt::encrypt($object);
    }

    public function decryptRequest($object){
        return Crypt::decrypt($object);
    }

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
            'email'=> ['required','string'],
            'password'=> ['required','string']
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
            'name'=> ['required','string'],
            'email'=> ['required','string'],
            'password'=> ['required','string']
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
