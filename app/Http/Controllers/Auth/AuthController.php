<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) {
        $credentials = $request->validated();
        $result = $this->authService->register($credentials);
        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($result['user']),
            'token' => $result['token']
        ], 201);
    }

    public function login(LoginRequest $request) {
        $credentials = $request->validated();
        $result = $this->authService->login($credentials);
        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $result['token'],
            'user' => new UserResource($result['user'])
        ], 200);
    }

    public function refresh(Request $request) {
        $user = $request->user();

        $currentToken = $user->currentAccessToken();

        if ($currentToken){
            $currentToken->delete();
        }

        $newToken = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'message' => 'Token refreshed successfully',
            'token' => $newToken
        ], 200);
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json([], 204);
    }

    public function me(Request $request) {
        return new UserResource($request->user());
    }
}
