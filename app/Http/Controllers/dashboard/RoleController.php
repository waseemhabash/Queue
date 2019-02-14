<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::orderBy("name", "desc")->get();

        return view("dashboard.roles.index", compact("roles"));

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        //
    }

    public function update(Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        //
    }
}
