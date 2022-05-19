<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @method static paginate(int $int)
 * @method static find($id)
 * @property mixed $full_name
 * @property mixed $email
 * @property mixed $question
 */
class Question extends Model
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

    public function createQuestion(Request $request): array
    {
        try {

            $validate = Validator::make($request->all(), [
                'full_name' => 'required',
                'email' => 'required',
                'question' => 'required'
            ]);
            if (!$validate->fails()){
                $question = new Question();
                $full_name = $request->input('full_name');
                $email = $request->input('email');
                $content = $request->input('question');
                $question->full_name = $full_name;
                $question->email = $email;
                $question->question = $content;
                $question->save();
                return $this->responseModel(true, $question);
            }
            return $this->responseModel(false, [], $validate->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getAllQuestion(): array
    {
        try {
            return $this->responseModel(true, Question::paginate(10));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getQuestionById($id): array
    {
        try {
            return $this->responseModel(true, Question::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
