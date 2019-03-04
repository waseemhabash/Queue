<?php

use App\Models\Privilege;
use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{

    public function run()
    {
        $privileges = [
            "admin_management",
            "role_management",
            "constant_management",
            "companies_management",
            "company",
            "branches_management",
            "branch",
        ];

        foreach ($privileges as $privilege) {
            $new_privilege = new Privilege();
            $new_privilege->name = $privilege;
            $new_privilege->save();

        }

    }
}
