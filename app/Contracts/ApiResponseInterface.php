<?php

namespace App\Contracts;

interface ApiResponseInterface
{
    public function success($data = null, $message = 'Success', $statusCode = 200);

    public function error($message = 'Error', $statusCode = 400, $errors = null);

    public function validationError($errors, $statusCode = 422);
}
