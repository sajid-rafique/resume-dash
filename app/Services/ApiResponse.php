<?php

namespace App\Services;

use App\Contracts\ApiResponseInterface;

class ApiResponse implements ApiResponseInterface
{
    public function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }

    public function error($message = 'Error', $statusCode = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ], $statusCode);
    }

    public function validationError($errors, $statusCode = 422)
    {
        return $this->error('Validation failed', $statusCode, $errors);
    }
}
