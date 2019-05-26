<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware("c_page:admin_management");
        $this->middleware("has_role:admin");
    }

    public function index()
    {
        $admins = User::where("type", "admin")->where('id', "!=", auth()->id())->get();

        return view('dashboard.admins.index', compact('admins'));
    }

    public function create()
    {

        return view('dashboard.admins.add');

    }

    public function store()
    {

        $admin = User::create_user("admin");

        return redirect('dashboard/admins')->with("success", __("dashboard.added_successfully"));
    }

    public function show($id)
    {
        //
    }

    public function edit(User $admin)
    {

        return view('dashboard.admins.edit', compact('admin'));
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
