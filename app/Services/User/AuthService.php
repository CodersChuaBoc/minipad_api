<?php

namespace App\Services\User;

use App\Http\core\Response;
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
            return Response::error([
                'email' => 'Email already exists',
            ], null, 409);
        }

        DB::beginTransaction();

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        if (!$user) {

            return Response::error([
                'message' => 'Failed to create user',
            ], null, 500);
        }

        $token = Auth::attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            DB::rollBack();
            return Response::error([
                'message' => 'Failed to create user',
            ], null, 500);
        }

        DB::commit();

        return Response::success(["message" => "User created successfully"], [
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 201);
    }

    public static function login(string $email, string $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return Response::error([
                'email' => 'Email not found',
            ], null, 404);
        }

        if (!Hash::check($password, $user->password)) {
            return Response::error([
                'password' => 'Invalid password',
            ], null, 401);
        }


        $token = Auth::attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            return Response::error([
                'message' => 'Failed to login user',
            ], null, 500);
        }

        return Response::success(["message" => "User logged in successfully"], [
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

        return Response::success(["message" => "User logged out successfully"], null, 200);
    }

    public static function refresh()
    {
        $token = Auth::refresh();

        return Response::success(["message" => "Token refreshed successfully"], [
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public static function forgotPassword($email)
    {
        // Check if the user exists
        $user = User::where('email', $email)->first();

        if (!$user) {
            return Response::error([
                'email' => 'Email not found',
            ], null, 404);
        }

        $service = new static;
        $otp = $service->generateOTP();

        try {
            $otpExist = Redis::get($email);
            if ($otpExist) {
                return Response::error([
                    'message' => 'Failed to send OTP',
                ], null, 500);
            }
        } catch (\Throwable $th) {
            return Response::error([
                'message' => 'Failed to send OTP',
            ], null, 500);
        }

        try {
            Redis::set($email, $otp);
            // Set the OTP to expire in 5 minutes
            Redis::expire($email, 300);
        } catch (\Throwable $th) {
            return Response::error([
                'message' => 'Failed to send OTP',
            ], null, 500);
        }

        try {
            Mail::to($email)->send(new SendingOTP($otp));
        } catch (\Throwable $th) {
            Redis::del($email);

            return Response::error([
                'message' => 'Failed to send OTP',
            ], null, 500);
        }

        return Response::success(["message" => "OTP sent successfully"], null, 200);
    }

    public static function validateOTP($email, $otp)
    {
        $otpExist = Redis::get($email);

        if (!$otpExist) {
            return Response::error([
                'message' => 'OTP expired',
            ], null, 400);
        }

        if ($otpExist != $otp) {
            return Response::error([
                'message' => 'Invalid OTP',
            ], null, 400);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return Response::error([
                'message' => 'User not found',
            ], null, 404);
        }

        $token = Auth::login($user);

        return Response::success(["message" => "OTP validated successfully"], [
            'user' => $user,
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
            return Response::error([
                'message' => 'User not found',
            ], null, 404);
        }

        $user->password = Hash::make($password);
        $user->save();

        return Response::success(["message" => "Password reset successfully"], null, 200);
    }

    public function generateOTP()
    {
        // Generate a random number between 100000 and 999999
        $otp = mt_rand(100000, 999999);
        return $otp;
    }
}
