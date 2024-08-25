<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        return UserFacade::login($request->data());
    }
}
