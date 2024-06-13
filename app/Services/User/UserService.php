<?php

namespace App\Services\User;

use App\Mail\SendingOTP;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Response;
use Illuminate\Http\Request;

class UserService
{
    public static function updateUser($input)
    {
//        $user = User::where('email', $email)->first();
//        if (!$user) {
//
//            return Response::error([
//                'message' => 'Failed to update user',
//            ], null, 500);
//        }
        DB::beginTransaction();

        $user = User::update([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'avatar' => $input['avatar'],
            'birthday' => $input['birthday'],
        ]);

        DB::commit();

        return Response::success(["message" => "User updated successfully"], [
            'user' => $user,
            'authorisation' => [
                'token' => $input['token'],
                'type' => 'bearer',
            ]
        ], 201);
    }
}
