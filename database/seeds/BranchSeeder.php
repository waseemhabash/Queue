<?php

use App\Models\Branch;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\Role_privilege;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{

    public function run()
    {

        Role::create([
            "name" => "فرع",
        ]);

        Privilege::create([
            "name" => "branch_management",
        ]
        );
        
        $role = Role::get_by_name("فرع");

        $privileges = Privilege::whereIn("name", [
            "branch_management",
            "services_management",
            "employees_management",
            "windows_management",
        ])->get();

        foreach ($privileges as $privilege) {
            $role_privilege = new Role_privilege();
            $role_privilege->role_id = $role->id;
            $role_privilege->privilege_id = $privilege->id;
            $role_privilege->save();
        }

        /**
         * Create Branch
         */

        $user = new User();
        $user->name = "Branch owner Name";
        $user->email = "Branch@email.com";
        $user->phone = "0933242093";
        $user->password = bcrypt("password");
        $user->type = "branch_manager";
        $user->save();

        $branch = new Branch();
        $branch->name = "Branch Name";
        $branch->address = "Branch Address";
        $branch->description = 'Branch description';
        $branch->lng = 36.29636509318212;
        $branch->lat = 33.51517910706413;
        $branch->company_id = 1;
        $branch->user_id = $user->id;
        $branch->save();

        $role_user = new Role_user();
        $role_user->user_id = $user->id;
        $role_user->role_id = $role->id;
        $role_user->save();
    }
}
