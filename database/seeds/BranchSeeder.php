<?php

use App\Models\Branch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{

    public function run()
    {

        $companies = [
            //شركة الهرم
            [
                "branches" =>
                [
                    [
                        "name" => "فرع باب مصلى",
                        "email" => "haramBranch1@gmail.com",
                        "phone" => "0966666666",
                        "address" => "ميدان , باب مصلى , مقابل كراج درعا",
                        "lng" => 36.3021022,
                        "lat" => 33.497859,
                        "open_time" => "9:00:00",
                        "close_time" => "16:00:00",
                        "minutes_before_closing" => 15,
                        "company_id" => 1,
                        "image" => 'assets/uploads/branches/1/haram.jpg',
                    ],
                    [
                        "name" => "فرع جسر فيكتوريا ",
                        "email" => "haramBranch2@gmail.com",
                        "phone" => "0977777777",
                        "address" => "جسر فكتوريا , جانب الحجاز",
                        "lng" => 36.2945912,
                        "lat" => 33.512354,
                        "open_time" => "10:00:00",
                        "close_time" => "17:30:00",
                        "minutes_before_closing" => 10,
                        "company_id" => 1,
                        "image" => 'assets/uploads/branches/2/haram.jpg',
                    ],
                ],

            ],
            //شركة سيرياتيل
            [
                "branches" =>
                [
                    [
                        "name" => "فرع جرمانا",
                        "email" => "syriatelBranch1@gmail.com",
                        "phone" => "0988888888",
                        "address" => "جرمانا , ساحة الرئيس",
                        "lng" => 36.3409232,
                        "lat" => 33.488554,
                        "open_time" => "9:00:00",
                        "close_time" => "16:15:00",
                        "minutes_before_closing" => 10,
                        "company_id" => 2,
                        "image" => 'assets/uploads/branches/3/syriatel.png',
                    ],
                    [
                        "name" => "فرع ساحة المحافظة",
                        "email" => "syriatelBranch2@gmail.com",
                        "phone" => "0999999999",
                        "address" => "ساحة المحافظة , شارع 29 أيار",
                        "lng" => 36.2932572,
                        "lat" => 33.516446,
                        "open_time" => "10:00:00",
                        "close_time" => "17:30:00",
                        "minutes_before_closing" => 20,
                        "company_id" => 2,
                        "image" => 'assets/uploads/branches/4/syriatel.jpg',
                    ],
                ],
            ],
        ];

        foreach ($companies as $company) {
            foreach ($company['branches'] as $branch) {
                $user = new User();
                $user->name = $branch['name'];
                $user->email = $branch['email'];
                $user->phone = $branch['phone'];
                $user->password = bcrypt("password");
                $user->type = "branch_manager";
                $user->created_at = Carbon::now()->subDays(40);

                $user->save();

                $new_branch = new Branch();
                $new_branch->name = $branch['name'];
                $new_branch->address = $branch['address'];
                $new_branch->lng = $branch['lng'];
                $new_branch->lat = $branch['lat'];
                $new_branch->open_time = $branch['open_time'];
                $new_branch->close_time = $branch['close_time'];
                $new_branch->minutes_before_closing = $branch['minutes_before_closing'];
                $new_branch->company_id = $branch['company_id'];
                $new_branch->image = $branch['image'];
                $new_branch->user_id = $user->id;
                $new_branch->created_at = Carbon::now()->subDays(40);
                $new_branch->save();
            }
        }

    }
}
