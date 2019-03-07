<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {
        if (auth()->check() && auth()->user()->type != "user") {
            return redirect("dashboard");
        }

        if (request()->isMethod("post")) {
            $inputs = request()->validate([
                "email" => "required|email",
                "password" => "required",
            ]);

            if (auth()->attempt($inputs)) {

                session()->put("privileges", auth()->user()->privileges());

                return redirect("dashboard");
            } else {
                return redirect("dashboard")->with("error", __("dashboard.invalid_access_informations"));
            }
        }

        return view("dashboard.login");
    }

    public function logout()
    {
        session()->forget("privileges");
        auth()->logout();

        return redirect("dashboard/login");
    }
}
