<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
    * Handle an incoming authentication request.
    */
    public function login()
    {
        try {
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                // successfull authentication
                $user = Auth::user();
    
                $user_token = $user->createToken('appToken')->accessToken;
    
                return $this->apiResponse->success([
                    'token' => $user_token,
                    'user'  => $user,
                ]);
            } else {
                return $this->apiResponse->error('Failed to authenticate.', 401);
            }
            
        } catch (\Throwable $th) {
            return $this->apiResponse->error($th->getMessage(), 500);
        }
    }
}
