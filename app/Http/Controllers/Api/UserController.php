<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AvatarUpdateRequest;
use App\Resource\User\CurrentUser;

class UserController extends Controller
{
    public function avatar(AvatarUpdateRequest $request): CurrentUser
    {

        return new CurrentUser(
            UserFacade::AvatarUpdate($request->avatar()));

    }
}
