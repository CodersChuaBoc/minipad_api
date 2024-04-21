<?php

namespace App\Services\User;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService {
    public static function register(string $email, string $name, string $password) {
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User already exists',
            ], 409);
        }

        DB::beginTransaction();

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        if(!$user) {

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user',
            ], 500);
        }

        $token = Auth::attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);

        }

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public static function login(string $email, string $password) {
        $user = User::where('email', $email)->first();

        if(!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        // compare the password
        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }


        $token = Auth::attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public static function logout() {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ]);
    }

    public static function refresh() {
        $token = Auth::refresh();

        return response()->json([
            'status' => 'success',
            'message' => 'Token refreshed successfully',
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}