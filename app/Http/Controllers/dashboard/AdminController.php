<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Role_user;
use App\Models\User;

class AdminController extends Controller
{

    public function index()
    {
        $admins = User::where("type", "admin")->where('id', "!=", auth()->id())->get();

        return view('dashboard.admins.index', compact('admins', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('dashboard.admins.add', compact('roles'));

    }

    public function store()
    {

        $admin = User::create_user("admin");

        request()->validate([
            "roles.*" => "required|exists:roles,id",
        ]);

        foreach (request("roles") as $role_id) {
            $role_user = new Role_user();
            $role_user->user_id = $admin->id;
            $role_user->role_id = $role_id;
            $role_user->save();
        }

        return redirect('dashboard/admins')->with("success", __("dashboard.added_successfully"));
    }

    public function show($id)
    {
        //
    }

    public function edit(User $admin)
    {
        $roles = Role::all();

        return view('dashboard.admins.edit', compact('roles', 'admin'));
    }

    public function update(User $admin)
    {
        $admin = User::update_user($admin);

        request()->validate([
            "roles.*" => "required|exists:roles,id",
        ]);

        $admin->roles()->detach();

        foreach (request("roles") as $role_id) {
            $role_user = new Role_user();
            $role_user->user_id = $admin->id;
            $role_user->role_id = $role_id;
            $role_user->save();
        }

        return redirect('dashboard/admins')->with("success", __("dashboard.updated_successfully"));
    }

    public function destroy(User $admin)
    {
        \DB::beginTransaction();

        try {
            $admin->roles()->detach();
            $admin->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();
        return redirect('dashboard/admins')->with("success", __("dashboard.deleted_successfully"));
    }
}
