<?php

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{

    public function run()
    {

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

    }
}
