<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;

/**
 * @property mixed $blog_id
 * @property mixed $content
 * @property mixed $full_name
 * @property mixed|null $contact
 * @method static paginate()
 * @method static find($id)
 */
class Comment extends Model
{
    use HasFactory;

    private function responseModel($status = false, $object = [], $error = null): array
    {
        return [
            'status' => $status,
            'object' => $object,
            'error' => $error
        ];
    }

    public function createBlogComment(Request $request): array
    {
        try {
            $validator = Validator::make($request->all(), [
                'blog_id' => 'required',
                'full_name' => 'required',
                'content' => 'required'
            ]);
            if (!$validator->fails()){
                $blog_id = $request->input('blog_id');
                $full_name = $request->input('full_name');
                $content = $request->input('content');
                $comment = new Comment();
                $comment->blog_id = $blog_id;
                $comment->full_name = $full_name;
                $comment->content = $content;
                $comment->save();
                return $this->getAllBlogComment($blog_id);
            }
            return $this->responseModel(false, [], $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getAllBlogComment($id): array
    {
        try {
            return $this->responseModel(true, Comment::query()->where('blog_id', $id)->get());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

}
