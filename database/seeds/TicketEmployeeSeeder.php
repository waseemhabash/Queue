<?php

use App\Models\TicketsEmployee;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "حسن الحموي";
        $user->email = "ticketsEmployee@email.com";
        $user->phone = "0464653138";
        $user->password = bcrypt("password");
        $user->type = "tickets_employee";
        $user->save();

        $ticketsEmployee = new TicketsEmployee();
        $ticketsEmployee->branch_id = 1;
        $ticketsEmployee->user_id = $user->id;
        $ticketsEmployee->save();

    }
}
