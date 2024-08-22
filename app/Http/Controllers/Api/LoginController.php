<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): false|string
    {
        return json_encode(UserFacade::login($request->data()));
    }
}
