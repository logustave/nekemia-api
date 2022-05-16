<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    public function index()
    {
        $categorie = (new Category())->getAllCategory();
        return view('pages.categorie.index',['object'=>$categorie["object"],'error'=>""]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        (new Category())->createCategory($request);
        return back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show($id)
    {
        $categorie=(new Category())->getCategoryById($id);
        return view('pages.categorie.information',['id'=>$id,"object"=>$categorie['object']]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function edit($id)
    {
        $categorie=(new Category())->getCategoryById($id);
        return view('pages.categorie.modifier',['id'=>$id,"object"=>$categorie['object']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request)
    {
        (new Category())->updateCategory($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy($id)
    {
        $categorie=(new Category())->deleteCategoryById($id);
        return redirect("categorie");
    }

    /**
     * @OA\Post(
     *      path="/v1/category",
     *      operationId="createCategory",
     *      tags={"Category"},
     *      summary="CREATE CATEGORY",
     *      description="CREATE CATEGORY",
     *      security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    required=true,
     *    description="Transmettre les informations",
     *          @OA\JsonContent(
     *              @OA\Property(property="label", type="string"),
     *              @OA\Property(property="description", type="string")
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

    public function createCategoryAPI(Request $request): JsonResponse
    {
        $category = (new Category)->createCategory($request);
        return response()->json(
            $category,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            $this->format
        );
    }
}
