<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successResponse($data = [], $code = HTTP_OK, $message = ''): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }


    protected function failResponse(string $message, $code = HTTP_BAD_REQUEST, $data = []): JsonResponse
    {
        return response()->json([
            'status' => 'failure',
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
