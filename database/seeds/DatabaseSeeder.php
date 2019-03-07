<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call("ConstantSeeder");
        $this->call("PrivilegeSeeder");
        $this->call("AdminSeeder");
        $this->call("CompanySeeder");
        $this->call("BranchSeeder");
        $this->call("WindowsSeeder");
    }
}
