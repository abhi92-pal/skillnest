<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function sendSuccess($message, $data = []){
        return response()->json(['message' => $message, 'data' => $data], 200);
    }

    protected function sendError($message, $errors = [], $code = 422){
        return response()->json(['message' => $message, 'errors' => $errors], $code);
    }
}
