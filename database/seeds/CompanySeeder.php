<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{

    public function run()
    {

        $user = new User();
        $user->name = "شركة الهرم";
        $user->email = "Company@email.com";
        $user->phone = "09888564232";
        $user->password = bcrypt("password");
        $user->type = "company_manager";
        $user->save();

        $company = new Company();
        $company->name = "شركة الهرم";
        $company->description = "شركة للقيام بالحوالات المالية";
        $company->logo = "logo";
        $company->user_id = $user->id;
        $company->save();

    }
}
