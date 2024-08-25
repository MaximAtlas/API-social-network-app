<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AvatarUpdateRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Resource\User\CurrentUser;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function avatar(AvatarUpdateRequest $request): CurrentUser|JsonResponse
    {

        $data = UserFacade::avatarUpdate($request->avatar());
        if (! ($data instanceof JsonResponse)) {
            return new CurrentUser($data
            );
        }

        return $data;

    }

    public function profile(): CurrentUser
    {
        return new CurrentUser(auth()->user());
    }

    public function update(UpdateUserRequest $request): CurrentUser|JsonResponse
    {
        $data = UserFacade::updateUser($request->data());
        if (! ($data instanceof JsonResponse)) {
            return new CurrentUser($data
            );
        }

        return $data;

    }
}
