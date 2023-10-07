<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Emails\ForgetPasswordEmail;
use Modules\Auth\Emails\VerificationMail;
use Modules\Auth\Entities\PasswordReset;
use Modules\Auth\Entities\User;
use Modules\Auth\Http\Requests\Api\LoginRequest;
use Modules\Auth\Http\Requests\Api\RegisterRequest;
use Modules\Auth\Http\Requests\Api\VerifyRequest;
use Modules\Auth\Transformers\Api\UserResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        try {
            $registerRequest['password'] = Hash::make($registerRequest['password']);
            $registerRequest['name'] = $registerRequest['first_name'] .' '. $registerRequest['last_name'];

            $user = User::create($registerRequest->all());

            $user->update([
                'email_verified_at' => Carbon::now(),
                'code' => null
            ]);

            $token = $user->createToken('verification_token')->plainTextToken;

            return api_response_success([
                'token' => $token,
                'user' => new UserResource($user),
            ]);

        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    public function login(LoginRequest $loginRequest)
    {
        $user = User::where('email', $loginRequest->email)->first();
        if ($user) {
            if (Hash::check($loginRequest->password, $user->password)) {
                $token = $user->createToken('login')->plainTextToken;

                return api_response_success([
                    'token' => $token,
                    'user' => new UserResource($user),
                ]);
            } else {
                return api_response_error("الرقم السري غير متطابق");
            }

        } else {
            return api_response_error('برجاء مراجعة بيانات والمحاوله مرة أخري');
        }
    }


    /**
     * logout user
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return api_response_success('تم تسجيل الخروج بنجاح');
    }

    public function forget_password(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
        ], [], [
            'email' => 'البريد الإلكتروني',
        ]);

        if ($validation->fails()) {
            return api_response_error($validation->errors()->first());
        }

        $user = User::where('email', $request->email)->first();

        $code = rand(100000, 999999);

        if (!$userpassreset = PasswordReset::where('email', $user->email)->first()) {
            $userpassreset = PasswordReset::create([
                'email' => $user->email,
                'token' => $code,
            ]);
        } else {
            $userpassreset->where('email' , $user->email)->update([
                'token' => $code,
            ]);
        }

        Mail::to($user->email)->send(new ForgetPasswordEmail($userpassreset->token));

        return api_response_success('تم إرسال الرمز التعريفي لبريدك الإلكتروني');
    }

    public function change_password(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => ['required', 'exists:users,email'],
            'token' => ['required'],
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed',
            ],
        ], [], [
            'email' => 'البريد الإلكتروني',
            'token' => 'الرمز التعريفي',
            'password' => 'الرقم السري الجديد',
        ]);

        if ($validation->fails()) {
            return api_response_error($validation->errors()->first());
        }

        $user = User::where('email', $request['email'])->first();

        if (!$user) {
            return api_response_error('لا توجد مثل هذه البيانات في قاعدة البيانات');
        }

        $resetRequest = PasswordReset::where('email', $request['email'])->first();

        if (!$resetRequest || $resetRequest->token != $request['token']) {
            return api_response_error('الرمز التعريفي غير صحيح');
        }
        $user->update([
            'password' => Hash::make($request['password']),
        ]);

        PasswordReset::where('email', $request['email'])->delete();

        $token = $user->createToken('login')->plainTextToken;

        return api_response_success([
            'token' => $token,
            'user' => new UserResource($user)
        ]);
    }
}
