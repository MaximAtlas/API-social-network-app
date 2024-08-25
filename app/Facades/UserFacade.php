<?php

namespace App\Facades;

use App\Services\UserService\Data\LoginUserData;
use App\Services\UserService\Data\RegisterUserData;
use App\Services\UserService\Data\UpdateUserData;
use App\Services\UserService\UserService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse register(RegisterUserData $data)
 * @method static JsonResponse login(LoginUserData $data)
 * @method static Authenticatable|JsonResponse AvatarUpdate(?UploadedFile $avatar)
 * @method static Authenticatable|JsonResponse updateUser(UpdateUserData $data)
 *
 * @see UserService
 */
class UserFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {

        return UserService::class;
    }
}
