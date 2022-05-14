<?php

namespace App\Models\v1;

use App\Mail\changeEmail;
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
use Illuminate\Validation\Rules\Password as Pw;

/**
 * @property mixed $full_name
 * @property mixed $email
 * @property mixed $contact
 * @property mixed $email_verified_at
 * @property mixed|null $pseudo
 * @property mixed $password
 * @property mixed $id
 * @method static find($id)
 * @method static paginate(int $int)
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

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getAllAdmin(): array
    {
        try {
            return $this->responseModel(true, Admin::paginate(10));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function getAdminById($id): array
    {
        try {
            return $this->responseModel(true, Admin::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function createAdmin(Request $request): array
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
                $emailToken = Str::random(32);
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

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function updateAdminDetails(Request $request): array{
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'full_name' => 'required',
                'contact' => 'required',
            ]);
            if (!$validator->fails()){
                $admin = Admin::find($request->input('id'));
                if ($admin){
                    $admin->full_name = $request->input('full_name');
                    $admin->contact = $request->input( 'contact');
                    $admin->save();
                    return $this->responseModel(true, Admin::find($request->input('id')));
                }
                return $this->responseModel(false, [], "admin does not exist");
            }
            return $this->responseModel(false, [], 'incorrect field');
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    #[ArrayShape(['status' => "string", 'object' => "null", 'error' => "null"])] public function updateEmail(Request $request): array
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'old_email' => 'required',
                'new_email' => 'required|different:old_email'
            ]);
            if (!$validator->fails()){
                $admin = Admin::find($request->input('id'));
                $emailToken = Str::random(32);
                $dto = [
                    'admin_id' => $admin->id,
                    'email_token' => $emailToken
                ];
                DB::table('checks')->insert($dto);
                $admin->email_verified_at = null;
                $admin->email = $request->input('new_email');
                $admin->save();
                $url = route('verified-email', $dto);
                Mail::to($admin->email)->send(new changeEmail($admin, $url));
                return $this->responseModel(true, $admin);
            }
            return $this->responseModel(false, [], 'incorrect field');
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
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
