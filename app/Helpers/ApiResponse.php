<?php

namespace App\Helpers;

class ApiResponse
{
    /**
     * @param array $result
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    static function success( $result = null, string $message = null, $code =200){
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
    static function fail($message, int $errorCode = 200){
        return response()->json([
            'error'=> true,
            'message' => $message,
            'data' => null
        ], $errorCode);
    }
}
