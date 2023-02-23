<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * @param $result
     * @param string|null $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */

    static function success( $result = null, string $message = null, $code =200) :JsonResponse
    {
        return response()->json([
            'error'=> false,
            'message' => $message,
            'data' => $result
        ], $code);
    }

    /**
     * @param $message
     * @param int $errorCode
     * @return \Illuminate\Http\JsonResponse
     */
    static function fail($message, int $errorCode = 200): JsonResponse
    {
        return response()->json([
            'error'=> true,
            'message' => $message,
            'data' => null
        ], $errorCode);
    }
}
