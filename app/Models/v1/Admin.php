<?php

namespace App\Models\v1;

use App\Mail\Password;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $full_name
 * @property mixed $email
 * @property mixed $contact
 * @property mixed|null $pseudo
 * @property mixed $password
 */
class Admin extends Model
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

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function createAdmin(Request $request)
    {
        if (Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required',
            'contact' => 'required'
        ])){
            $full_name = $request->input('full_name');
            $email = $request->input('email');
            $contact = $request->input('contact');
            $pseudo = $request->input('contact') ? $request->input('contact') : null;
            $admin = DB::table('admins')
                ->where('email', $email)
                ->orWhere('contact', $contact)
                ->first();
            if ($admin) return $this->responseModel(false, [], "admin already exist"); else{
                $password = $request->input(Str::random(15));
                $admin = new Admin();
                $admin->full_name = $full_name;
                $admin->email = $email;
                $admin->contact = $contact;
                $admin->pseudo = $pseudo;
                $admin->password = $password;
                $admin->save();
                Mail::to($email)->send(new Password($email, $full_name, $url));
                return $this->responseModel(true, $admin);
            }
        }
        try {

            return $this->responseModel(false, [], "Question & answer is required");
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

}
