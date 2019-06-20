<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User;
use JWTAuth;

class AuthController extends Controller
{
    public function signup()
    {
        validate([
            "phone" => "required",
        ]) ?? exit;

        $user = User::where("phone", request("phone"))->first();

        if ($user && $user->type != "customer") {
            error_res([
                "message" => "غير مسموح لك باستخدام هذا التابع",
            ]);
            exit;
        }

        if (!$user) {
            $user = new User();
            $user->phone = request("phone");
            $user->type = "customer";
            $user->save();
        }

        $token = JWTAuth::fromUser($user);

        res(['Authorization' => "Bearer " . $token], 200);

        exit;
    }

    public function register_device()
    {
        $user = userFromToken();

        validate([
            "notify_token" => "required|unique:devices,notify_token",
        ]) ?? exit;

        $device = new Device();
        $device->notify_token = request("notify_token");
        $device->user_id = $user->id;

        $device->save();

        res();
        exit;
    }

}
