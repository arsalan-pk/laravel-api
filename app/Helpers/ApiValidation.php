<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiValidation
 * @package App\Helpers
 */
class ApiValidation
{
    /**
     * @param string $message
     * @param array $errors
     * @param int $statusCode
     * @return void
     * @throws HttpResponseException
     */
    public static function invalid($errors = [], string $message = 'Submitted Request is Not Valid',  int $statusCode = 422): void
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        } else {
            $response['errors'] = 'Error Message Not Found';
        }

        throw new HttpResponseException(response()->json($response, $statusCode));
    }

    public static function invalidCredentials($errors = '', string $message = 'Submitted Request is Not Valid',  int $statusCode = 422): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        } else {
            $response['errors'] = 'Error Message Not Found';
        }

        return response()->json($response, $statusCode);
    }
    public static function invalidApi($errors = '', string $message = 'Submitted Request is Not Valid',  int $statusCode = 422): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        } else {
            $response['errors'] = 'Error Message Not Found';
        }

        return response()->json($response, $statusCode);
    }
}
