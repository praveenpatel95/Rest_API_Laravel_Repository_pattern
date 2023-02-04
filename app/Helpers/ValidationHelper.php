<?php

namespace App\Helpers;

use App\Exceptions\BadRequestException;
use App\Exceptions\ValidationRequestException;
use Illuminate\Support\Facades\Validator;

class ValidationHelper
{
    static function validate($data, $rules){
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new ValidationRequestException($validator->errors());
        }
        return !$validator->fails();
    }
}
