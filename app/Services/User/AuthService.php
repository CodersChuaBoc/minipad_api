<?php

namespace App\Services\User;

use App\Mail\SendingOTP;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class AuthService
{
    public static function register(string $email, string $name, string $password)
    {
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

        if (!$user) {

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

    public static function login(string $email, string $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

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

    public static function logout()
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ]);
    }

    public static function refresh()
    {
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

    public static function forgotPassword($email)
    {
        $service = new static;
        $otp = $service->generateOTP();

        try {
            $otpExist = Redis::get($email);
            if ($otpExist) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'OTP already sent',
                ], 409);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP',
            ], 500);
        }

        try {
            Redis::set($email, $otp);
            // Set the OTP to expire in 5 minutes
            Redis::expire($email, 300);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP',
            ], 500);
        }

        try {
            Mail::to($email)->send(new SendingOTP($otp));
        } catch (\Throwable $th) {
            Redis::del($email);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully',
        ]);
    }

    public static function validateOTP($email, $otp)
    {
        $otpExist = Redis::get($email);

        if (!$otpExist) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP expired',
            ], 400);
        }

        if ($otpExist != $otp) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP',
            ], 400);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'OTP validated successfully',
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public static function resetPassword($password)
    {
        //get $email from token
        $email = Auth::user()->email;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $user->password = Hash::make($password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset successfully',
        ]);
    }

    public function generateOTP()
    {
        // Generate a random number between 100000 and 999999
        $otp = mt_rand(100000, 999999);
        return $otp;
    }
}
