<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AvatarUpdateRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\CurrentUserResource;
use App\Http\Resources\User\SubscriberResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function avatar(AvatarUpdateRequest $request): CurrentUserResource|JsonResponse
    {

        $data = UserFacade::avatarUpdate($request->avatar());
        if (! ($data instanceof JsonResponse)) {
            return new CurrentUserResource($data
            );
        }

        return $data;

    }

    public function profile(): CurrentUserResource
    {
        return new CurrentUserResource(auth()->user());
    }

    public function update(UpdateUserRequest $request): CurrentUserResource|JsonResponse
    {
        $data = UserFacade::updateUser($request->data());
        if (! ($data instanceof JsonResponse)) {
            return new CurrentUserResource($data
            );
        }

        return $data;
    }

    public function getById(User $user): CurrentUserResource
    {
        return new CurrentUserResource($user);
    }

    public function getUserPosts(User $user)
    {
        $posts = $user->posts()->get();

        return PostResource::collection($posts);
    }

    public function subscribers(User $User)
    {
        $subscribers = $User->subscriptions()->get();

        return SubscriberResource::collection($subscribers);
    }

    public function subscribe(User $User)
    {
        return responseMessage($User->subscribe()->value, 200, 'state');
    }
}
