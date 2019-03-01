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


}
