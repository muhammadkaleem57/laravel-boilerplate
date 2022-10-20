<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ExceptionLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function signup(SignupRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validatedRequest = $request->validated();
            $validatedRequest['password'] = Hash::make($validatedRequest['password']);

            User::create($validatedRequest);

            return $this->successResponse([], HTTP_OK, 'A verification email sent to your account, please verify your account');

        } catch (\Exception $exception) {
            return $this->failResponse('Some error occurred ' . $exception->getMessage());
        }
    }

    public function verifyAccount(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        try {
            if (!is_object($user))
                return $this->failResponse('Account Not Found');

            if ($user->verification_code !== $request->code)
                return $this->failResponse('Verification Code mismatch');

            $user->email_verified_at = now();
            $user->is_active = YES;
            $user->verification_code = null;
            $user->save();

            return $this->successResponse([], HTTP_OK, 'Account successfully verified now you can Login');

        } catch (\Exception $exception) {
            return $this->failResponse('Some error occurred ' . $exception->getMessage());
        }
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if(!auth()->attempt($request->only('email', 'password')))
            return $this->failResponse(trans('auth.failed'));

        try {
            $user = auth()->user();
            $user->is_online = true;
            $user->save();

            $token = $user->createToken('Laravel boillerplate Personal Access Client')->accessToken;

            return $this->successResponse([
                'token' => $token,
                'user' => new UserResource($user)
            ], HTTP_OK, 'Successfully Login');

        }catch (\Exception $exception) {
            return $this->failResponse($exception->getMessage());
        }
    }

    public function user(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();

        return $this->successResponse([
            'user' => new UserResource($user)
        ]);
    }
}
