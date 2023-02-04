<?php

namespace App\Exceptions;
use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class ValidationRequestException extends Exception
{
    public function render(Request $request)
    {
        return ApiResponse::fail(json_decode($this->message), 422);
    }
}
