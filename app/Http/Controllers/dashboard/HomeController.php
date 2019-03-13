<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware("c_page:home");
    }

    public function index()
    {
        return view('dashboard.layouts.index');
    }

}
