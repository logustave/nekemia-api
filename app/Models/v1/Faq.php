<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @method static find($id)
 * @method static paginate(int $int)
 * @property mixed $question
 * @property bool|mixed $answer
 */
class Faq extends Model
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

    public function createFaq(Request $request): array
    {
        try {
            $validate = Validator::make($request->all(), [
                'question' => 'required|unique:faqs,question',
                'answer'=> 'required'
            ]);
            if (!$validate->fails()){
                $faq = new Faq();
                $faq->question = $request->input('question');
                $faq->answer = $request->input('answer');
                $faq->save();
                return $this->responseModel(true, $faq);
            }
            return $this->responseModel(false, [], $validate->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function updateFaq(Request $request): array
    {
        try {
            $validate = Validator::make($request->all(), [
                'question' => 'required',
                'answer'=> 'required'
            ]);
            if (!$validate->fails()){
                $faq = Faq::find($request->input('id'));
                if (!$faq) {
                    $result =  $this->responseModel(false, [], "Question does not exist");
                } else{
                    $faq->question = $request->input('question');
                    $faq->answer = $request->input('answer');
                    $faq->save();
                    $result = $this->responseModel(true, $faq);
                }
            }
            return $this->responseModel(false, [], $result ?? $validate->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getAllFaq(): array
    {
        try {
            return $this->responseModel(true, Faq::paginate(10));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getFaqById($id): array
    {
        try {
            $faq = Faq::find($id);
            if ($faq){
                return $this->responseModel(true,$faq);
            }
            return $this->responseModel(false, [], "Faq with id { $id } does not exist.");
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function deleteFaqById($id): array
    {
        try {
            return $this->responseModel(true, Faq::find($id)->delete());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
