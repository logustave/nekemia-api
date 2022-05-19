<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = (new Admin())->getAllAdmin();
        return view('pages.comptes.index',['admin'=>$admin['object']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        $data= (new Admin())->createAdmin($request);
        return redirect("comptes");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view("pages.comptes.ajouter");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin =  (new Admin())->getAdminById($id);
        return view('pages.comptes.information',['object'=>$admin['object']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin=(new Admin())->getAdminById($id);
        return view('pages.comptes.modifier',['id'=>$id,"object"=>$admin['object']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        (new Admin())->updateAdminDetails($request);
        return redirect("comptes/information/$request->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin=(new Admin())->deleteAdmin($id);
        return redirect("comptes");
    }
    public function authAdmin(Request $request){
        $admin= (new Admin())->authAdmin($request);
//        return redirect("dashboard");
        return $admin;
    }

    public function signIn(){
        return view("login");
    }
    public function signOut(){
//        (new Admin())->logoutAdmin();
        Cookie::forget('isConnected');

//        $cokie=Cookie::get('user_pseudo');


    }

    /**
     * @OA\Post(
     *      path="/v1/admin",
     *      operationId="createAdmin",
     *      tags={"Administrateur"},
     *      summary="CREATE ADMINISTRATOR",
     *      description="CREATE ADMINISTRATOR",
     *      security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    required=true,
     *    description="Transmettre les informations",
     *          @OA\JsonContent(
     *              @OA\Property(property="full_name", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="contact", type="string"),
     *              @OA\Property(property="pseudo", type="string")
     *          ),
     * ),
     *     @OA\Response(
     *          response=200,
     *          description="Opération éffectuée",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Interdit"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Mauvaise demande"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="pas trouvé"
     *   ),
     *  )
     */

    public function createAdminAPI(Request $request): JsonResponse
    {
        $admin = (new Admin)->createAdmin($request);
        return response()->json(
            $admin,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            $this->format
        );
    }

    public function verifiedAdminEmail($id,$token): string {
        $email = (new Admin)->verifiedAdminEmail($id, $token);
        if ($email){
            return 'Verified';
        }
        return 'Not Verified';
    }
}
