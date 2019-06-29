<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("has_role:admin");
    }

    public function index()
    {
        $page = "إدارة المسؤولين";
        session()->put("c_page", "admin_management");

        $admins = User::where("type", "admin")->where('id', "!=", auth()->id())->get();

        return view('dashboard.admin.admins.index', compact('admins', "page"));
    }

    public function create()
    {
        $page = "إضافة مسؤول";
        session()->put("c_page", "admin_management");

        return view('dashboard.admin.admins.add', compact("page"));

    }

    public function store()
    {
        $admin = User::create_user("admin");

        return redirect('dashboard/admins')->with("success", "تمت إضافة المسؤول بنجاح");
    }

    public function show($id)
    {
        //
    }

    public function edit(User $admin)
    {
        $page = "تعديل مسؤول";
        session()->put("c_page", "admin_management");

        return view('dashboard.admin.admins.edit', compact('admin', 'page'));
    }

    public function update(User $admin)
    {
        $admin = User::update_user($admin);

        return redirect('dashboard/admins')->with("success", __("dashboard.updated_successfully"));
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect('dashboard/admins')->with("success", __("dashboard.deleted_successfully"));
    }
}
