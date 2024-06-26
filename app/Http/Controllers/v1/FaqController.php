<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $faq = (new Faq())->getAllFaq();
        return view('pages.faq.index',['object'=>$faq["object"],'error'=>""]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(Request $request)
    {
        $data= (new Faq())->createFaq($request);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Faq $faq
     * @return Response
     */
    public function show($id)
    {
        $faq=(new faq())->getFaqById($id);
        return view('pages.faq.information',['id'=>$id,"object"=>$faq['object']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Faq $faq
     * @return Response
     */
    public function edit($id)
    {
        $faq=(new Faq())->getFaqById($id);
        return view('pages.faq.modifier',['id'=>$id,"object"=>$faq['object']]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        (new Faq())->updateFaq($request);
        return redirect("faq/information/$request->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faq $faq
     * @return Response
     */
    public function destroy($id)
    {
        $faq=(new Faq())->deleteFaqById($id);
        return redirect("faq");
    }



    /**
     * @OA\Get(
     *      path="/v1/faq?page={page}",
     *      operationId="getAllFaqAPI",
     *      tags={"FAQ"},
     *      summary="GET FAQ",
     *      description="GET FAQ",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Opération éffectuée",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean"),
     *              @OA\Property(
     *                  property="object",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="data",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="id", type="integer", format="number", example="0"),
     *                              @OA\Property(property="question", type="string"),
     *                              @OA\Property(property="answer", type="string"),
     *                              @OA\Property(property="order", type="integer"),
     *                              @OA\Property(property="created_at", type="string"),
     *                              @OA\Property(property="update_at", type="string"),
     *                              @OA\Property(property="delete_at", type="string"),
     *                          ),
     *                      ),
     *                  ),
     *              ),
     *          @OA\Property(property="error", type="string"),
     *          ),
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
    public function getAllFaqAPI(): JsonResponse
    {
        $faq = (new Faq)->getAllFaq();
        return response()->json(
            $faq,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            $this->format
        );
    }


//    /**
//     * @OA\Get(
//     *      path="/v1/faq/{id}",
//     *      operationId="getFaqByIdAPI",
//     *      tags={"FAQ"},
//     *      summary="GET FAQ",
//     *      description="GET FAQ",
//     *      security={{"bearerAuth":{}}},
//     *  @OA\Parameter(
//     *      name="id",
//     *      in="path",
//     *      required=true,
//     *      @OA\Schema(
//     *           type="integer"
//     *      )
//     *   ),
//     *     @OA\Response(
//     *          response=200,
//     *          description="Opération éffectuée",
//     *          @OA\JsonContent(
//     *              @OA\Property(property="status", type="boolean"),
//     *              @OA\Property(
//     *                  property="object",
//     *                  type="array",
//     *                  @OA\Items(
//     *                      @OA\Property(property="id", type="integer", format="number", example="0"),
//     *                      @OA\Property(property="question", type="string"),
//     *                      @OA\Property(property="answer", type="string"),
//     *                      @OA\Property(property="order", type="integer"),
//     *                      @OA\Property(property="created_at", type="string"),
//     *                      @OA\Property(property="update_at", type="string"),
//     *                      @OA\Property(property="delete_at", type="string"),
//     *                  ),
//     *              ),
//     *          @OA\Property(property="error", type="string"),
//     *          ),
//     *      ),
//     *      @OA\Response(
//     *          response=401,
//     *          description="Non authentifié",
//     *      ),
//     *      @OA\Response(
//     *          response=403,
//     *          description="Interdit"
//     *      ),
//     * @OA\Response(
//     *      response=400,
//     *      description="Mauvaise demande"
//     *   ),
//     * @OA\Response(
//     *      response=404,
//     *      description="pas trouvé"
//     *   ),
//     *  )
//     */
//    public function getFaqByIdAPI($id): JsonResponse
//    {
//        $faq = (new Faq)->getFaqById($id);
//        return response()->json(
//            $faq,
//            200,
//            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
//            $this->format
//        );
//    }
}
