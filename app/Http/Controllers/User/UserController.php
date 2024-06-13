<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Response;

class UserController extends Controller
{
//    //
//    public static function middleware(): array
//    {
//        return [
//            new Middleware(middleware: 'auth:api', except: ['update']),
//        ];
//    }

    public function updateUser(Request $request)
    {
        $rule = [
            "email" => "required|email",
            "phone_number" => "required",
            "name" => "required",
            "birthday" => "required",
        ];


        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return Response::error($validator->errors());
        }
        $input = $request->all();
        return UserService::updateUser($input);
    }
}
