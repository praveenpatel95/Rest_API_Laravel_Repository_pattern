<?php

namespace App\Exceptions;

use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class NotFoundException extends Exception
{

    private $name;

    /**
     * NotFoundException constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(Request $request)
    {
        return ApiResponse::fail(__('auth.not_found',['name' => $this->name] ), 404);
    }
}
