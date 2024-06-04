<?php 
namespace App\Http\core;

class Response {
    static function success($message, $data = null, $status = 200) {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'code' => 1
        ], $status);
    }

    static function error($message, $data = null, $status = 400) {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'code' => 0
        ], $status);
    }
}