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
        $this->call("AdminSeeder");
        $this->call("CompanySeeder");
        $this->call("BranchSeeder");
        $this->call("ServiceSeeder");
        
        $this->call("WindowsSeeder");
        $this->call("EmployeeSeeder");
        $this->call("TicketEmployeeSeeder");
        $this->call("CustomerSeeder");
        $this->call("QueueSeeder");
        $this->call("RateSeeder");
    }
}
