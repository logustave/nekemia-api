<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static paginate(int $int)
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

    public function getBlogBySlug($slug){

    }
}
