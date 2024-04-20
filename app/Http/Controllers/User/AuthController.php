<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends  Controller
{
    public function register(Request $request) {
        $rule = [
            "email"=> "required|email",
            "password"=> "required|min:6|max:50",
        ];

        return response()->json([
            "message"=> "register success",
        ]);
    }
}
