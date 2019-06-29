<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Constant;

class ConstantController extends Controller
{

    public function __construct()
    {
        $this->middleware("has_role:admin");
    }

    public function index()
    {
        $page = "الثوابت";
        session()->put("c_page", "constant_management");

        $constants = Constant::all();
        return view("dashboard.admin.settings.constant", compact("constants", "page"));
    }

    public function update()
    {
        Constant::update_constant();
        return back()->with("success", "تم تعديل الثوابت بنجاح");
    }

}
