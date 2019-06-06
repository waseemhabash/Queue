<?php

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{

    public function run()
    {

        $user = new User();
        $user->name = "أحمد حامد";
        $user->email = "Branch@email.com";
        $user->phone = "09888564231";
        $user->password = bcrypt("password");
        $user->type = "branch_manager";
        $user->save();

        $branch = new Branch();
        $branch->name = "فرع الميدان";
        $branch->address = "ميدان جزماتية";
        $branch->description = 'هذا الفرع أنشأ عام 1999';
        $branch->lng = 36.29636509318212;
        $branch->lat = 33.51517910706413;
        $branch->open_time = "9:00:00";
        $branch->close_time = "16:00:00";
        $branch->company_id = 1;
        $branch->user_id = $user->id;
        $branch->save();

    }
}
