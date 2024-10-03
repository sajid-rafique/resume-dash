<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

use App\Contracts\ApiResponseInterface; // Make sure the correct namespace is used for the interface.
use Illuminate\Support\Facades\App;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Handle unauthenticated exceptions.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        // Resolve the ApiResponseInterface from the container
        $apiResponse = App::make(ApiResponseInterface::class);
        
        // // Get the bearer token from the request header
        // $bearerToken = $request->header('Authorization');

        // // Check if the bearer token is present
        // if (!$bearerToken) {
        //     return response()->json(['message' => 'Authorization header is missing'], 401);
        // }

        // Use the interface to generate a response
        return $apiResponse->error('You are unautherized to use this service', 401);
    }
}
