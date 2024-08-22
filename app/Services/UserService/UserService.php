<?php

namespace App\Services\UserService;

use App\Models\User;
use App\Services\UserService\Data\LoginUserData;
use App\Services\UserService\Data\RegisterUserData;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;

class UserService
{
    public function register(RegisterUserData $data)
    {

        $user = User::query()->create($data->toArray());

        return $user->createToken('api_register')->plainTextToken;
    }

    public function login(LoginUserData $data)
    {

        if (! auth('web')->attempt($data->toArray())) {
            responseError(__('Not correct user data'), 401);
        }
        $user = Auth::guard('api')->user();

        $user->tokens()->delete();

        /** @var NewAccessToken $token */
        $token = $user->createToken('api_login');

        return ['token' => $token->plainTextToken];
    }
}
