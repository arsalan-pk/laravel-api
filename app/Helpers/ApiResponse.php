<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function withData($data = [], string $message = 'Request Successfully Proceeded',  int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        } else {
            $response['data'] = 'Data Not Fetched';
        }

        return response()->json($response, $statusCode);
    }

    public static function withSuccess(string $message = 'Request  Proceeded',  int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];
        return response()->json($response, $statusCode);
    }

    public static function withError($error = '', string $message = 'Request  Proceeded',  int $statusCode = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'error' => $error,
        ];
        return response()->json($response, $statusCode);
    }
}
