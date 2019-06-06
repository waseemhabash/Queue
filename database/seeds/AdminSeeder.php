<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $user = new User();
        $user->name = "المسؤول العام";
        $user->email = "admin@admin.com";
        $user->phone = "09888564230";
        $user->password = bcrypt("password");
        $user->type = "admin";
        $user->save();

    }
}
