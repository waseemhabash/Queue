<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Privilege;
use App\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::orderBy("name", "desc")->with("privileges")->get();

        return view("dashboard.roles.index", compact("roles"));

    }

    public function create()
    {
        $privileges = Privilege::all();
        return view("dashboard.roles.add", compact("privileges"));
    }

    public function store()
    {
        Role::store_role();
        return redirect("dashboard/roles")->with("success", __("dashboard.added_successfully"));
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $privileges = Privilege::all();
        return view("dashboard.roles.edit", compact("role", "privileges"));
    }

    public function update(Role $role)
    {
        Role::update_role($role);
        return redirect("dashboard/roles")->with("success", __("dashboard.updated_successfully"));

    }

    public function destroy(Role $role)
    {
        \DB::beginTransaction();

        try {
            $role->privileges()->detach();
            $role->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();
        return back()->with("success", __("dashboard.deleted_successfully"));
    }
}
