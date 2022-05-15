<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static paginate(int $int)
 * @method static find($slug)
 * @property mixed $category_id
 * @property mixed $admin_id
 * @property mixed $title
 * @property mixed $content
 */
class Blog extends Model
{
    use HasFactory;

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] private function responseModel($status = false, $object = [], $error = null): array
    {
        return [
            'status' => $status,
            'object' => $object,
            'error' => $error
        ];
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getAllBlog(Request $request): array
    {
        try {
            $search = $request->input('search') ? $request->input('search') : null;
            if ($search){
                $blog =  Blog::query()
                    ->where('title', 'LIKE', "%$search%")
                    ->orWhere('content', 'LIKE', "%$search%")
                    ->paginate(10);
            }else{
                $blog = Blog::paginate(10);
            }
            return $this->responseModel(true, $blog);
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getBlogBySlug($slug): array
    {
        try {
            $blog = Blog::query()->where('slug', $slug)->first();
            return $this->responseModel(true, $slug);
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function createBlog(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'creator_id' => 'required',
                'category_id' => 'required',
                'title' => 'required',
                'content' => 'required'
            ]);
            if (!$validator->fails()){
                $creator_id = $request->input('creator_id');
                $category_id = $request->input('category_id');
                $title = $request->input('title');
                $content = $request->input('content');
                $blog = new Blog();
                $blog->category_id = $category_id;
                $blog->admin_id = $creator_id;
                $blog->title = $title;
                $blog->content = $content;
                $blog->save();
                return $this->responseModel(true, $this->getAllBlogComment($blog_id));
            }
            return $this->responseModel(false, [], $validator->failed());
        }catch (Exception $e){

        }
    }

    public function updateBlogById(Request $request){
        try {

        }catch (Exception $e){

        }
    }
}
