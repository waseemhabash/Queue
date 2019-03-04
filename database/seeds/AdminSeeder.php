<?php

use App\Models\Privilege;
use App\Models\Role;
use App\Models\Role_privilege;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $user = new User();
        $user->name = "وسيم الحبش";
        $user->email = "admin@admin.com";
        $user->phone = "0949042001";
        $user->password = bcrypt("password");
        $user->type = "admin";
        $user->save();

        Role::create([
            "name" => "المسؤول العام",
        ]);

        $role_user = new Role_user();
        $role_user->user_id = 1;
        $role_user->role_id = 1;
        $role_user->save();

        $privileges = Privilege::whereNotIn("name", ['company', 'branch'])->get();

        foreach ($privileges as $privilege) {
            $role_privilege = new Role_privilege();
            $role_privilege->role_id = 1;
            $role_privilege->privilege_id = $privilege->id;
            $role_privilege->save();
        }

    }
}
