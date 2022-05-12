<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Documentation des APIs de Nekiema APIs",
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

    public function cryptRequest($object): string {
        return Crypt::encrypt($object);
    }

    public function decryptRequest($object){
        return Crypt::decrypt($object);
    }

    public int $format = JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

}
