<?php

namespace App\Exceptions;
use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class BadRequestException extends Exception
{
    public function render(Request $request)
    {
        return ApiResponse::fail($this->message, 400);
    }
}
