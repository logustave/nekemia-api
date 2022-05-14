<?php

namespace App\Models\v1;

use App\Mail\Password;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Djunehor\Sms\Concrete\RingCaptcha;
use Illuminate\Validation\Rules\Password as Pw;

/**
 * @property mixed $full_name
 * @property mixed $email
 * @property mixed $contact
 * @property mixed|null $pseudo
 * @property mixed $password
 * @property mixed $id
 * @method static find($id)
 */
class Admin extends Model
{
    use HasFactory;

    private mixed $email_verified_at;

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
            'email' => 'required|email',
            'contact' => 'required'
        ])){
            $full_name = $request->input('full_name');
            $email = $request->input('email');
            $contact = $request->input('contact');
            $pseudo = $request->input('pseudo') ? $request->input('pseudo') : null;
            $password = Str::random(15);
            $admin = DB::table('admins')
                ->where('email', $email)
                ->orWhere('contact', $contact)
                ->first();
            if ($admin) return $this->responseModel(false, [], "admin already exist"); else{
                $sms = new RingCaptcha();
                $emailToken = Str::random(32);;
                $sms->text("Code de vérification: 0569")->to($contact)->from('NEKEMIA BTP')->send();
                $admin = new Admin();
                $admin->full_name = $full_name;
                $admin->email = $email;
                $admin->pseudo = $pseudo;
                $admin->contact = $contact;
                $admin->password = Hash::make($request->input(Str::random(15)));
                $admin->save();
                $url = route('verified-email', [
                    'id' => $admin->id,
                    'token' => $emailToken
                ]);
                DB::table('checks')->insert([
                    'admin_id' => $admin->id,
                    'email_token' => $emailToken
                ]);
                Mail::to($email)->send(new Password($admin, $password, $url));
                return $this->responseModel(true, $admin);
            }
        }
        try {

            return $this->responseModel(false, [], "Question & answer is required");
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }


    public function verifiedAdminEmail($id,$token): bool
    {
        $verified = DB::table('checks')
            ->where('admin_id', $id)
            ->where('email_token', $token)
            ->first();
        if ($verified){
            DB::table('admins')->where('id', $id)->update([
                'email_verified_at'=>date("Y-m-d H:i:s")
            ]);
            DB::table('checks')
                ->where('admin_id', $id)
                ->where('email_token', $token)
                ->delete();
            return true;
        }
        return false;
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function updateAdminPassword(Request $request): array
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'old' => 'required',
                'new' => ['required','different:old'],
                'repeat' => ['required','same:new',
                    Pw::min(8)->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                ]
            ]);
            if (!$validator->failed()){
                DB::table('admins')->where('id', $request->input('id'))->update([
                    'password'=>Hash::make($request->input('repeat')),
                    'password_verified_at' => date("Y-m-d H:i:s")
                ]);
                return $this->responseModel(true, Admin::find($request->input('id')));
            }
            return $this->responseModel(false, [], '');
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
