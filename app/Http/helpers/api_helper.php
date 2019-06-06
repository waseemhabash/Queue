<?php

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
function validate($rules)
{
    $validation = Validator::make(request()->all(), $rules);

    if ($validation->fails()) {
        error_res([
            "validateErrors" => $validation->errors(),
        ]);

        return null;
    }

    return true;
}
function userFromToken()
{
    $user = JWTAuth::parseToken()->authenticate();
    return User::find($user->id);
}

function error_res($array = [], $state = 500, $headers = [])
{
    $array["state"] = false;

    return response()->json($array, $state, $headers)->send();
}

function res($array = [], $state = 200, $headers = [])
{
    $array["state"] = true;

    return response()->json($array, $state, $headers)->send();
}
