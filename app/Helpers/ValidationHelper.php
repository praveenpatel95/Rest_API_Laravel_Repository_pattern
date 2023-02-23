<?php

namespace App\Helpers;

use App\Exceptions\BadRequestException;
use App\Exceptions\ValidationRequestException;
use Illuminate\Support\Facades\Validator;

class ValidationHelper
{
    /**
     * Check request data validate
     * @param $data
     * @param $rules
     * @return bool
     * @throws ValidationRequestException
     */
    static function validate($data, $rules){
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new ValidationRequestException($validator->errors());
        }
        return !$validator->fails();
    }
}
