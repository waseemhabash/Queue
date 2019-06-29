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

        $employees =
            [

            [
                "name" => "بيان قديمي",
                "email" => "bayanTicketsEmployee@gmail.com",
                "phone" => "0927537373",
                "branch_id" => 1,
            ],
            [
                "name" => "حسن النجار",
                "email" => "hasanAlnajarticketsEmployee@gmail.com",
                "phone" => "0927538873",
                "branch_id" => 2,
            ],
            [
                "name" => "محمود الحمش",
                "email" => "mahmoudAlhemshTicketsEmployee@gmail.com",
                "phone" => "0927530000",
                "branch_id" => 3,
            ],
            [
                "name" => "ميرا بازري",
                "email" => "meraTicketsEmployee@gmail.com",
                "phone" => "0924557373",
                "branch_id" => 4,
            ],

        ];

        foreach ($employees as $employee) {
            $user = new User();
            $user->name = $employee['name'];
            $user->email = $employee["email"];
            $user->phone = $employee["phone"];
            $user->password = bcrypt("password");
            $user->type = "tickets_employee";
            $user->save();

            $ticketsEmployee = new TicketsEmployee();
            $ticketsEmployee->branch_id = $employee["branch_id"];
            $ticketsEmployee->user_id = $user->id;
            $ticketsEmployee->save();
        }

    }
}
