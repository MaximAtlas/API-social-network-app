<?php

namespace App\Facades;

use App\Services\UserService\Data\LoginUserData;
use App\Services\UserService\Data\RegisterUserData;
use App\Services\UserService\UserService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method static RegisterUserData register($array)
 * @method static LoginUserData login($array)
 * @method static UploadedFile|null AvatarUpdate
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
