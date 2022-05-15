<?php

namespace App\Models\v1;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $full_name
 * @property mixed $email
 * @property mixed $author_number
 * @property mixed $object
 * @property mixed $message
 * @method static paginate(int $int)
 * @method static find($id)
 */
class Contact extends Model
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

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function createMessage(Request $request): array
    {
        try {
            $validate = Validator::make($request->all(), [
                'full_name' => 'required',
                'email' => 'required',
                'author_number' => 'required',
                'object' => 'required',
                'message' => 'required'
            ]);
            if ($validate->fails()){
                $contact = new Contact;
                $full_name = $request->input('full_name');
                $email = $request->input('email');
                $author_number = $request->input('author_number');
                $object = $request->input('object');
                $message = $request->input('message');
                $contact->full_name = $full_name;
                $contact->email = $email;
                $contact->author_number = $author_number;
                $contact->object = $object;
                $contact->message = $message;
                $contact->save();
                return $this->responseModel(true, $contact);
            }
            return $this->responseModel(false, [], $validate->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getAllMessage(): array
    {
        try {
            return $this->responseModel(true, Contact::paginate(10));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getMessageById($id): array
    {
        try {
            return $this->responseModel(true, Contact::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
