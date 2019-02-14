<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        session()->put("c_page", "home");
        return view('dashboard.layouts.index');
    }

    public function login()
    {
        if (auth()->check()) {
            return redirect("dashboard/home");
        }

        if (request()->isMethod("post")) {
            $inputs = request()->validate([
                "email" => "required|email",
                "password" => "required",
            ]);

            if (auth()->attempt($inputs)) {

                session()->put("privileges", login_user()->privileges());

                return redirect("dashboard/home");
            } else {
                return redirect("dashboard/home")->with("error",__("dashboard.invalid_access_informations"));
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
