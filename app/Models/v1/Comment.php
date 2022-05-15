<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\ArrayShape;
use Exception;
use Illuminate\Http\Request;

/**
 * @property mixed $blog_id
 * @property mixed $comment
 * @property mixed $full_name
 * @property mixed|null $contact
 * @method static paginate()
 * @method static find($id)
 */
class Comment extends Model
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

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function createBlogComment(Request $request): array
    {
        try {
            $validator = Validator::make($request->all(), [
                'blog_id' => 'required',
                'full_name' => 'required',
                'comment' => 'required'
            ]);
            if (!$validator->fails()){
                $blog_id = $request->input('blog_id');
                $full_name = $request->input('full_name');
                $comment_user = $request->input('comment');
                $contact = $request->input('contact') ? $request->input('contact') : null;
                $comment = new Comment();
                $comment->blog_id = $blog_id;
                $comment->full_name = $full_name;
                $comment->comment = $comment_user;
                $comment->contact = $contact;
                $comment->save();
                return $this->responseModel(true, $this->getAllBlogComment($blog_id));
            }
            return $this->responseModel(false, [], $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getAllBlogComment($id): array
    {
        try {
            return $this->responseModel(true, Comment::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

}
