<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{

    public function run()
    {

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
