<?php

namespace App\Facades;

use App\Models\User;
use App\Services\UserService\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static User store($array)
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
