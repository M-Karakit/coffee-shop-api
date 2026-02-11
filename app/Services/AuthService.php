<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): array {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $token = $user->createToken('auth-token')->plainTextToken;

            return [
                'token' => $token,
                'user' => $user
            ];

        } catch (Exception $e) {
            throw new \Exception("Error registering Request: " . $e->getMessage());
        }
    }

    public function login(array $data) {
            $user = User::where('email', $data['email'])->first();

            if (!$user || !Hash::check($data['password'], $user['password'])){
                throw ValidationException::withMessages([
                    'email' => 'invalid email credentials',
                    'password' => 'invalid password'
                ]) ;
            }

            $token = $user->createToken('auth-token')->plainTextToken;

            return [
                'token' => $token,
                'user' => $user
            ];
    }
}
