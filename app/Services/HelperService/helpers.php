<?php

use Illuminate\Http\JsonResponse;

function responseMessage(string $message = "success", int $code = 200): JsonResponse
{
    return response()->json(["message" => "$message"], $code);
}

function responseError(string $message = "not success", int $code = 200): JsonResponse
{
    return response()->json(["error" => "$message"], $code);
}
