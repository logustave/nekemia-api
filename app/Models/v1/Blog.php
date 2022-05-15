<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static paginate(int $int)
 * @method static find($slug)
 * @property mixed $category_id
 * @property mixed $admin_id
 * @property mixed $title
 * @property mixed $content
 * @property array|mixed|string|string[] $slug
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
            return $this->responseModel(true, $blog);
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function createBlog(Request $request): array
    {
        try {
            $validator = Validator::make($request->all(), [
                'creator_id' => 'required',
                'category_id' => 'required',
                'title' => 'required',
                'content' => 'required',
                'cover_path' => 'required'
            ]);
            if (!$validator->fails()){
                $file = $request->file('cover_path');
                $file_extension = $file->getClientOriginalExtension();
                $file_name = Str::uuid().$file_extension;
                Storage::disk('blog')->put($file_name, $file->getContent());
                $cover_path = asset("blog/$file_name", true);
                $creator_id = $request->input('creator_id');
                $category_id = $request->input('category_id');
                $title = $request->input('title');
                $slug = str_replace($title, ' ', '-');
                $content = $request->input('content');
                $blog = new Blog();
                $blog->category_id = $category_id;
                $blog->slug = $slug;
                $blog->admin_id = $creator_id;
                $blog->$cover_path = $cover_path;
                $blog->title = $title;
                $blog->content = $content;
                $blog->save();
                return $this->responseModel(true, $blog);
            }
            return $this->responseModel(false, [], $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function updateBlogById(Request $request): array
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'category_id' => 'required',
                'title' => 'required',
                'content' => 'required',
                'cover_path' => 'required'
            ]);
            if (!$validator->fails()){
                $category_id = $request->input('category_id');
                $title = $request->input('title');
                $slug = str_replace($title, ' ', '-');
                $content = $request->input('content');
                $blog = Blog::find($request->input('id'));
                if ($request->file('cover_path')){
                    $file = $request->file('cover_path');
                    $file_extension = $file->getClientOriginalExtension();
                    $file_name = Str::uuid().$file_extension;
                    Storage::disk('blog')->put($file_name, $file->getContent());
                    $cover_path = asset("blog/$file_name", true);
                    $blog->$cover_path = $cover_path;
                }
                $blog->category_id = $category_id;
                $blog->title = $title;
                $blog->slug = $slug;
                $blog->content = $content;
                $blog->save();
                return $this->responseModel(true, $blog);
            }
            return $this->responseModel(false, [], $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
