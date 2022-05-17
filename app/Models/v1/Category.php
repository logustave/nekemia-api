<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @property mixed $label
 * @property bool|mixed $description
 * @method static find($id)
 * @method static paginate(int $int)
 */
class Category extends Model
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

    public function createCategory(Request $request): array
    {
        try {
            $validate = Validator::make($request->all(), [
                'label' => 'required|unique:categories,label',
            ]);
            if (!$validate->fails()){
                $category = new Category();
                $category->label = $request->input('label');
                $category->description = $request->input('description');
                $category->save();
                return $this->responseModel(true, $category);
            }
            return $this->responseModel(false, [], $validate->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function updateCategory(Request $request): array
    {
        try {
            $validate = Validator::make($request->all(), [
                'id' => 'required',
                'label' => 'required'
            ]);
            if (!$validate->fails()){
                $category = Category::find($request->input('id'));
                if (!$category) {
                    $result = $this->responseModel(false, [], "category does not exist");
                } else{
                    $category->label = $request->input('label');
                    $category->description = $request->input('description');
                    $category->save();
                    $result =  $this->responseModel(true, $category);
                }
                return $this->responseModel(false, [], $result);
            }
            return $this->responseModel(false, [], $validate->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getAllCategory(): array
    {
        try {
            return $this->responseModel(true, Category::paginate(5));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getAllCategoryWithoutPagination(): array
    {
        try {
            return $this->responseModel(true, Category::All());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getCategoryById($id): array
    {
        try {
            return $this->responseModel(true, Category::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function deleteCategoryById($id): array
    {
        try {
            return $this->responseModel(true, Category::find($id)->delete());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
