<?php

namespace App\Services\UserService;

use App\Models\User;
use App\Services\UserService\Data\LoginUserData;
use App\Services\UserService\Data\RegisterUserData;
use App\Services\UserService\Data\UpdateUserData;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;
use PHPUnit\Exception;

class UserService
{
    public function register(RegisterUserData $data): JsonResponse
    {

        $user = User::query()->create($data->toArray());

        return response()->json($user->createToken('api_register')->plainTextToken, 200);
    }

    public function login(LoginUserData $data): JsonResponse
    {

        if (! auth('web')->attempt($data->toArray())) {
            return responseError(__('Not correct user data'), 401);
        }
        $user = Auth::guard('api')->user();

        $user->tokens()->delete();

        /** @var NewAccessToken $token */
        $token = $user->createToken('api_login');

        return response()->json($token->plainTextToken, 200);
    }

    public function avatarUpdate(?UploadedFile $avatar): Authenticatable|JsonResponse
    {
        try {
            $url = null;
            if (! is_null($avatar)) {
                $path = $avatar->storePublicly('avatar');
                $url = config('app.url')."/storage/$path";
            }
            Auth::user()->update([
                'avatar' => ($url),
            ]);

            return auth()->user();
        } catch (Exception $e) {
            return responseError(__('Error upload avatar'), 400);
        }
    }

    public function updateUser(UpdateUserData $data): Authenticatable|JsonResponse
    {
        try {
            if (! empty($data->toArray())) {
                auth()->user()->update($data->toArray());
            } else {
                return responseError(__('No updated data '), 204, 'No content');
            }

            return auth()->user();
        } catch (\Exception $e) {
            return responseError(__('Error Update data)'), 500);
        }
    }
}
