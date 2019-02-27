<?php

use App\Models\Privilege;
use App\Models\Role;
use App\Models\Role_privilege;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{

    public function run()
    {
        $privileges = [
            "admin_management",
            "role_management",
            "constant_management",

        ];

        $user = new User();
        $user->name = "وسيم الحبش";
        $user->email = "admin@admin.com";
        $user->phone = "0949042001";
        $user->password = bcrypt("password");
        $user->save();

        $role = new Role();
        $role->name = "المسؤول العام";
        $role->save();

        $role_user = new Role_user();
        $role_user->user_id = $user->id;
        $role_user->role_id = $role->id;
        $role_user->save();

        foreach ($privileges as $privilege) {
            $new_privilege = new Privilege();
            $new_privilege->name = $privilege;
            $new_privilege->save();

            $role_privilege = new Role_privilege();
            $role_privilege->role_id = $role->id;
            $role_privilege->privilege_id = $new_privilege->id;
            $role_privilege->save();
        }

    }
}
