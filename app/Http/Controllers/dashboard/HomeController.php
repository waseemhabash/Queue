<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $page = "الصفحة الرئيسية";
        session()->put("c_page", "home");

        if (is_type("admin")) {

            return view('dashboard.admin.home', compact("page"));
        } elseif (is_type("company_manager")) {
            return view('dashboard.company.home', compact("page"));
        } elseif (is_type("branch_manager")) {
            return view('dashboard.branch.home', compact("page"));
        }

    }
}
