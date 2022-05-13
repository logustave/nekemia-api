<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $label
 * @property bool|mixed $description
 * @method static find()
 */
class Category extends Model
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

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function createCategory(Request $request): array
    {
        try {
            if (Validator::make($request->all(), [
                'label' => 'required',
            ])){
                $label = DB::table('categories')
                    ->where('label', $request->input('label'))
                    ->first();
                if ($label) return $this->responseModel(false, [], `category $label already exist`); else{
                    $category = new Category();
                    $category->label = $request->input();
                    $category->description = $request->input('description') && $request->input('description');
                    $category->save();
                    return $this->responseModel(true, $category);
                }
            }
            return $this->responseModel(false, [], "label is required");
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function updateCategory(Request $request): array
    {
        try {
            if (Validator::make($request->all(), [
                'label' => 'required',
            ])){
                $category = Category::find($request->input('id'));
                if (!$category) return $this->responseModel(false, [], `category does not exist`); else{
                    $category->label = $request->input();
                    $category->description = $request->input('description') && $request->input('description');
                    $category->save();
                    return $this->responseModel(true, $category);
                }
            }
            return $this->responseModel(false, [], "label is required");
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getAllCategory(): array
    {
        try {
            return $this->responseModel(true, Category::all());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getCategoryById($id): array
    {
        try {
            return $this->responseModel(true, Category::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function deleteCategoryById($id): array
    {
        try {
            return $this->responseModel(true, Category::find($id)->deleted());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}