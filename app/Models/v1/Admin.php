<?php

namespace App\Models\v1;

use App\Mail\changeEmail;
use App\Mail\Password;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

    private function responseModel($status = false, $object = [], $error = null): array
    {
        return [
            'status' => $status,
            'object' => $object,
            'error' => $error
        ];
    }

    public function authAdmin(Request $request): array {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ]);
            if (!$validator->fails()){
                $username = $request->input('username');
                $password = $request->input('password');
                $auth = Admin::query()
                    ->where('email', $username)
                    ->orWhere('pseudo', $username)
                    ->orWhere('contact', $username)
                    ->first();
                if (isset($auth->password) && Hash::check($password, $auth->password)){
                    if ($auth->email_verified_at){
                        $time = 60 * 24 * 7 * 30;
                        Cookie::queue('isConnected', true, $time);
                        Cookie::queue('user_id', Hash::make($auth->id), $time);
                        Cookie::queue('user_full_name', $auth->full_name, $time);
                        Cookie::queue('user_pseudo', $auth->pseudo, $time);
                        Cookie::queue('session_id', $auth->id, $time);
                        Cookie::queue('user_email', $auth->email, $time);
                        Cookie::queue('user_contact', $auth->contact, $time);
                        return $this->responseModel(true, $auth);
                    } else {
                        $result = $this->responseModel(false, [], 'Confirmer votre adresse email');
                    }
                }else{
                    $result = $this->responseModel(false, [], 'Identifiant ou mot de passe incorrect');
                }
            }
            return $this->responseModel(false, [], $result ?? $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function logoutAdmin(): array
    {
        try {
            Cookie::forget('isConnected');
            Cookie::forget('user_id');
            Cookie::forget('user_full_name');
            Cookie::forget('user_pseudo');
            Cookie::forget('session_id');
            Cookie::forget('user_email');
            Cookie::forget('user_contact');
            return $this->responseModel(true);
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function resendVerificationEmail(Request $request):array{
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);
            if (!$validator->fails()){
                $email = $request->input('email');
                $resend = Admin::query()
                    ->where('email', $email)
                    ->first();
                $emailToken = Str::random(32);
                $password = Str::random(15);
                $resend->password = Hash::make($password);
                $resend->save();
                DB::table('checks')->insert(['admin_id' => $resend->id, 'email_token' => $emailToken]);
                $url = route('verified-email', ['id' => $resend->id, 'token' => $emailToken]);
                Mail::to($email)->send(new Password($resend, $password, $url));
                return $this->responseModel(true, $resend);
            }
            return $this->responseModel(false, $validator->failed());
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

    public function getAllAdmin(): array
    {
        try {
            return $this->responseModel(true, Admin::paginate(10));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function getAdminById($id): array
    {
        try {
            return $this->responseModel(true, Admin::find($id));
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function createAdmin(Request $request): array
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'email' => 'required|email',
                'contact' => 'required'
            ]);
            if (!$validator->fails()){
                $full_name = $request->input('full_name');
                $email = $request->input('email');
                $contact = $request->input('contact');
                $pseudo = $request->input('pseudo') ? $request->input('pseudo') : null;
                $password = Str::random(15);
                $admin = DB::table('admins')
                    ->where('email', $email)
                    ->orWhere('contact', $contact)
                    ->first();
                if ($admin) {
                    $result = $this->responseModel(false, [], "admin already exist");
                } else{
                    $emailToken = Str::random(32);
                    $admin = new Admin();
                    $admin->full_name = $full_name;
                    $admin->email = $email;
                    $admin->pseudo = $pseudo;
                    $admin->contact = $contact;
                    $admin->password = Hash::make($password);
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
                    $result = $this->responseModel(true, $admin);
                }
            }
            return $this->responseModel(false, [], $result ?? $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function updateAdminDetails(Request $request): array{
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
                    $result = $this->responseModel(true, Admin::find($request->input('id')));
                }else{
                    $result = $this->responseModel(false, [], "admin does not exist");
                }
            }
            return $this->responseModel(false, [], $result ?? $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function updateAdminEmail(Request $request): array
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
            return $this->responseModel(false, [], $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function updateAdminPassword(Request $request): array
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
            return $this->responseModel(false, [], $validator->failed());
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }

    public function deleteAdmin($id): array {
        try {
            $admin = Admin::query()->find($id)->delete();
            if ($admin){
                return $this->responseModel(true, $admin);
            }
            return $this->responseModel(false, [], 'Action failed');
        }catch (Exception $e){
            return $this->responseModel(false, [], $e);
        }
    }
}
