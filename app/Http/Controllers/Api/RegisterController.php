<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): false|string
    {
        return json_encode(UserFacade::register($request->data()));  //return user-token
    }
}
