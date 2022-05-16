<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = (new Blog())->getAllBlog();
        return view('pages.blog.index',['object'=>$blog["object"],'error'=>""]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data= (new Blog())->createBlog($request);
        return back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\v1\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog=(new Blog())->getBlogBySlug($slug);
        return view('pages.blog.information',['id'=>$slug,"object"=>$blog['object']]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\v1\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $blog=(new Blog())->getBlogBySlug($slug);
        return view('pages.blog.modifier',['slug'=>$slug,"object"=>$blog['object']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\v1\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        (new Blog())->updateCategory($request);
        return redirect("blog/information/$request->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\v1\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog=(new Blog())->deleteCategoryById($id);
        return redirect("blog");
    }

    /**
     * @OA\Post (
     *      path="/v1/blog?page={page}",
     *      operationId="getAllFaqBlogAPI",
     *      tags={"BLOG"},
     *      summary="GET ALL BLOG",
     *      description="GET ALL BLOG",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=false,
     *          description="Transmettre les informations",
     *              @OA\JsonContent(
     *                  @OA\Property(property="search", type="string")
     *              ),
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
     *                              @OA\Property(property="category_id", type="string"),
     *                              @OA\Property(property="slug", type="string"),
     *                              @OA\Property(property="admin_id", type="integer"),
     *                              @OA\Property(property="cover_path", type="string"),
     *                              @OA\Property(property="title", type="string"),
     *                              @OA\Property(property="content", type="string"),
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
    public function getAllBlog(Request $request): JsonResponse
    {
        $blog = (new Blog)->getAllBlog($request);
        return response()->json(
            $blog,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            $this->format
        );
    }

    /**
     * @OA\Get(
     *      path="/v1/blog/{slug}",
     *      operationId="getBlogBySlugdAPI",
     *      tags={"BLOG"},
     *      summary="GET BLOG BY SLUG",
     *      description="GET BLOG BY SLUG",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="slug",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
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
     *                              @OA\Property(property="category_id", type="string"),
     *                              @OA\Property(property="slug", type="string"),
     *                              @OA\Property(property="admin_id", type="integer"),
     *                              @OA\Property(property="cover_path", type="string"),
     *                              @OA\Property(property="title", type="string"),
     *                              @OA\Property(property="content", type="string"),
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
    public function getBlogBySlugAPI($slug): JsonResponse
    {
        $blog = (new Blog)->getBlogBySlug($slug);
        return response()->json(
            $blog,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            $this->format
        );
    }
}
