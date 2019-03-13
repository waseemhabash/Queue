<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $user = new User();
        $user->name = "وسيم الحبش";
        $user->email = "admin@admin.com";
        $user->phone = "0949042001";
        $user->password = bcrypt("password");
        $user->type = "admin";
        $user->save();

    }
}
