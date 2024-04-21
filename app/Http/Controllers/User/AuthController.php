<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\AuthService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller implements HasMiddleware
{
    //
    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'register']),
        ];
    }

    public function register(Request $request) {
        $rule = [
            "email"=> "required|email",
            "password"=> "required|min:6|max:50",
            "name" => "required",
        ];


        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return response()->json([
                "message"=> $validator->errors(),
            ]);
        }
        
        $email = $request->email;
        $name = $request->name;
        $password = $request->password;

        return AuthService::register($email, $name, $password);
    }

    public function login(Request $request) {
        $rule = [
            "email"=> "required|email",
            "password"=> "required|min:6|max:50",
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return response()->json([
                "message"=> $validator->errors(),
            ]);
        }

        $email = $request->email;
        $password = $request->password;

        return AuthService::login($email, $password);
    }

    public function logout() {
        return AuthService::logout();
    }

    public function refresh() {
        return AuthService::refresh();
    }
}
