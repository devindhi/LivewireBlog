<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterationRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use PgSql\Lob;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        Log::info('in register control');
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'contact' => $request->contact,
        ];

        $result = $this->userService->register($data);
        return response()->json([
            'message' => 'User registered successfully'
        ]);
    }


    public function login(Request $request)
    {
        Log::info('Login method called in controller');

        $data = [
            "email" => $request->email,
            "password" => $request->password
        ];

        $result = $this->userService->login($data);

        Log::info('User authenticated successfully', [$result->id]);

      
        $token = JWTAuth::fromUser($result);
        Log::info('JWT token generated', ['token' => $token]);
        // Store the token in a cookie
        Cookie::queue(Cookie::make('jwt_token', $token, 60 * 24)); // 1 day expiration

    
        return response()->json([
            'message' => 'User authenticated successfully'
        ])->header('Authorization', 'Bearer ' . $token);
    }
}
