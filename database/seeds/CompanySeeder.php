<?php

use App\Models\Company;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\Role_privilege;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{

    public function run()
    {

        Role::create([
            "name" => "شركة",
        ]);

        Privilege::create([
            "name" => "company_management",
        ]
        );

        $role = Role::get_by_name("شركة");

        $privileges = Privilege::whereIn("name", [
            "company_management",
            "branches_management",
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
         * Create Company
         */

        $user = new User();
        $user->name = "Company Manager";
        $user->email = "Company@email.com";
        $user->phone = "0944438229";
        $user->password = bcrypt("password");
        $user->type = "company_manager";
        $user->save();

        $company = new Company();
        $company->name = "Company Name";
        $company->description = "Company Description";
        $company->logo = "logo";
        $company->user_id = $user->id;
        $company->save();

        $role_user = new Role_user();
        $role_user->user_id = $user->id;
        $role_user->role_id = $role->id;
        $role_user->save();

    }
}
