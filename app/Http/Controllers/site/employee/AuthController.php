<?php

namespace App\Http\Controllers\site\employee;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {

        if (is_type("services_employee")) {
            return redirect("employee");
        }

        if (request()->isMethod("post")) {
            request()->validate([
                "email" => "required|email|exists:users,email",
                "password" => "required",
            ]);

            if (auth()->attempt(["email" => request("email"), "password" => request("password")], true)) {
                if (!is_type("services_employee")) {
                    auth()->logout();
                    return back()->with("error", "غير مسموح لك بالدخول إلى هنا");
                }

                $employee = myEmployee();

                $active_window = $employee->window;

                $active_employee = $active_window->employee();

                if ($active_employee && $active_employee->id != $employee->id) {
                    auth()->logout();
                    return back()->with("error", $active_employee->user->name . " قام بتسجيل الدخول بالفعل على النافذة  <br>" . $active_window->prefix . "<br> اطلب منه تسجيل الخروج أولاً");
                }

                $active_window->employees()->update(["active" => 0]);

                $employee->active = 1;
                $employee->update();


                return redirect("employee");

            } else {
                return back()->with("error", "المعلومات المدخلة خاطئة");
            }

        }

        return view("site.employee.login");
    }

    public function logout()
    {

        $employee = myEmployee();
        $employee->active = 0;
        $employee->update();
        auth()->logout();
        return redirect("employee/login");
    }
}
