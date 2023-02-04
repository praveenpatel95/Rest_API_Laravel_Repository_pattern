<?php

namespace App\Exceptions;
use App\Helpers\ApiResponse;
use Exception;
class ForbiddenException extends Exception
{
    public function render(){
        return ApiResponse::fail($this->message ?? __('auth.forbidden'),403);
    }
}
