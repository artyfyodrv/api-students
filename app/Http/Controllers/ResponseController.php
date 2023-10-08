<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ResponseController extends Controller
{
    public function sendResponse($data): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $data
        ];
        return response()->json($response);
    }

    public function sendError($error, $code): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error
        ];

        return response()->json($response, $code);
    }
}
