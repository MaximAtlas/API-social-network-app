<?php

use Illuminate\Http\JsonResponse;

function responseMessage(string $message = 'success', int $code = 200, $status = 'message'): JsonResponse
{
    return response()->json([$status => "$message"], $code);
}

function responseError(string $message = 'not success', int $code = 404, string $error = 'error'): JsonResponse
{
    return response()->json(['$error' => "$message"], $code);
}
