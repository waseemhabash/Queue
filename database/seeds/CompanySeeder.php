<?php

use App\Models\Company;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\Role_privilege;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{

    public function run()
    {

        Role::create([
            "name" => "شركة",
        ]);

        $privilege = Privilege::get_by_name("company");
        $role = Role::get_by_name("شركة");

        $role_privilege = new Role_privilege();
        $role_privilege->role_id = $role->id;
        $role_privilege->privilege_id = $privilege->id;
        $role_privilege->save();

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

    }
}
