<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class CompanySeeder extends Seeder
{

    public function run()
    {

        $companies = [
            [
                "name" => "شركة الهرم",
                "email" => "haramCompany@gmail.com",
                "phone" => "0944444444",
                "description" => "شركة دولية , تعنى بتحويل و استقبال النقود",
                "logo" => 'assets/uploads/companies/1/haram.png',
            ],
            [
                "name" => "شركة سيرياتيل",
                "email" => "syriatelCompany@gmail.com",
                "phone" => "0955555555",
                "description" => "شركة اتصالات متعددة الخدمات , يمكنك التواصل معنا عن طريق الاتصال ب 222",
                "logo" => 'assets/uploads/companies/2/syriatel.jpg',
            ],
        ];

        foreach ($companies as $company) {
            $user = new User();
            $user->name = $company["name"];
            $user->email = $company['email'];
            $user->phone = $company['phone'];
            $user->password = bcrypt("password");
            $user->type = "company_manager";
            $user->created_at = Carbon::now()->subDays(40);
            $user->save();

            $new_company = new Company();
            $new_company->name = $company["name"];
            $new_company->description = $company["description"];
            $new_company->logo = $company['logo'];
            $new_company->user_id = $user->id;
            $new_company->created_at = Carbon::now()->subDays(40);

            $new_company->save();
        }

    }
}
