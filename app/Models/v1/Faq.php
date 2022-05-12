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
 * @method static find($id)
 * @property mixed $question
 * @property bool|mixed $answer
 */
class Faq extends Model
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

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function createFaq(Request $request): array
    {
        try {
            if (Validator::make($request->all(), [
                'question' => 'required',
                'answer'=> 'required'
            ])){
                $question = DB::table('categories')
                    ->where('question', $request->input('question'))
                    ->first();
                if ($question) return $this->responseModel(false, [], `Question $question already exist`); else{
                    $faq = new Faq();
                    $faq->question = $request->input();
                    $faq->answer = $request->input('answer') && $request->input('answer');
                    $faq->save();
                    return $this->responseModel(true, $faq);
                }
            }
            return $this->responseModel(false, [], "Question & answer is required");
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function updateFaq(Request $request): array
    {
        try {
            if (Validator::make($request->all(), [
                'question' => 'required',
                'answer'=> 'required'
            ])){
                $faq = Faq::find($request->input('id'));
                if (!$faq) return $this->responseModel(false, [], `Question does not exist`); else{
                    $faq->question = $request->input();
                    $faq->answer = $request->input('answer') && $request->input('answer');
                    $faq->save();
                    return $this->responseModel(true, $faq);
                }
            }
            return $this->responseModel(false, [], "Question & answer is required");
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getAllFaq(): array
    {
        try {
            return $this->responseModel(true, Faq::all());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getFaqById($id): array
    {
        try {
            return $this->responseModel(true, Faq::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function deleteFaqById($id): array
    {
        try {
            return $this->responseModel(true, Faq::find($id)->deleted());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
