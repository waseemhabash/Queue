<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function privileges()
    {
        return $this->belongsToMany("App\Models\Privilege", "role_privileges", "role_id", "privilege_id");
    }

    public function has_privilege($privilege_id)
    {
        return $this->privileges->find($privilege_id);
    }

    public static function get_by_name($role_name)
    {
        return Role::where("name",$role_name)->first();
    }

    public static function store_role()
    {
        request()->validate([
            "name" => "required|unique:roles,name",
            "privileges.*" => "required|exists:privileges,id",
        ]);

        $role = new Role();
        $role->name = request("name");
        $role->save();

        foreach (request("privileges") as $privilege_id) {
            $role_privilege = new Role_privilege();
            $role_privilege->role_id = $role->id;
            $role_privilege->privilege_id = $privilege_id;
            $role_privilege->save();
        }
    }

    public static function update_role($role)
    {
        request()->validate([
            "name" => "required|unique:roles,name,$role->id",
            "privileges.*" => "required|exists:privileges,id",
        ]);

        $role->name = request("name");
        $role->update();

        $role->privileges()->detach();

        foreach (request("privileges") as $privilege_id) {
            $role_privilege = new Role_privilege();
            $role_privilege->role_id = $role->id;
            $role_privilege->privilege_id = $privilege_id;
            $role_privilege->save();
        }
    }
}
