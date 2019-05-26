<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User;
use App\Models\User_device;
use JWTAuth;

class AuthController extends Controller
{
    public function signup()
    {
        validate([
            "phone" => "required",
        ]) ?? exit;

        $user = User::where("phone", request("phone"))->first();

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
            "system" => "required|in:IOS,ANDROID",
        ]) ?? exit;

        $device = new Device();
        $device->notify_token = request("notify_token");
        $device->system = request("system");
        $device->save();

        $user_device = new User_device();
        $user_device->user_id = $user->id;
        $user_device->device_id = $device->id;
        $user_device->save();

        res();
        exit;
    }

    public function update_device()
    {
        validate([
            "old_notify_token" => "required|exists:devices,notify_token",
            "new_notify_token" => "required",
        ]) ?? exit;

        $device = Device::where("notify_token", request("old_notify_token"))->first();

        $device->notify_token = request("new_notify_token");

        $device->update();

        res();
        exit;
    }

}
