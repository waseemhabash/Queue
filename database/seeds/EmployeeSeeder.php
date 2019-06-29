<?php

use App\Models\Employee;
use App\Models\Employee_service;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{

    public function run()
    {
        $branches =
            [

            [
                "employees" =>
                [

                    [
                        "name" => "وسيم الحبش",
                        "email" => "waseemEmploye@gmail.com",
                        "phone" => "09955663344",
                        "branch_id" => "1",
                        "window_id" => 1,
                        "service_id" => 1,
                    ],
                    [
                        "name" => "أحمد حامد",
                        "email" => "ahmadEmploye@gmail.com",
                        "phone" => "09933441177",
                        "branch_id" => "1",
                        "window_id" => 2,
                        "service_id" => 2,
                    ],

                ],
            ],

            [
                "employees" =>
                [

                    [
                        "name" => "رند الكاتب",
                        "email" => "randEmploye@gmail.com",
                        "phone" => "09988776655",
                        "branch_id" => 2,
                        "window_id" => 3,
                        "service_id" => 3,
                    ],
                    [
                        "name" => "ليان جمعة زبادنة",
                        "email" => "laeanEmploye@gmail.com",
                        "phone" => "09654783212",
                        "branch_id" => 2,
                        "window_id" => 4,
                        "service_id" => 4,
                    ],

                ],
            ],

            [
                "employees" =>
                [

                    [
                        "name" => "سميرة محمد",
                        "email" => "sameraEmploye@gmail.com",
                        "phone" => "091122334477",
                        "branch_id" => 3,
                        "window_id" => 5,
                        "service_id" => 7,
                    ],
                    [
                        "name" => "أحمد الحموي",
                        "email" => "ahmadHamoyEmploye@gmail.com",
                        "phone" => "09654003212",
                        "branch_id" => 3,
                        "window_id" => 6,
                        "service_id" => 6,
                    ],

                ],
            ],

            [
                "employees" =>
                [

                    [
                        "name" => "وجد عيون السود",
                        "email" => "wajdEmploye@gmail.com",
                        "phone" => "091122555477",
                        "branch_id" => 4,
                        "window_id" => 7,
                        "service_id" => 9,
                    ],
                    [
                        "name" => "علي طبّش",
                        "email" => "aliTabshEmploye@gmail.com",
                        "phone" => "09674583212",
                        "branch_id" => 4,
                        "window_id" => 8,
                        "service_id" => 10,
                    ],

                ],
            ],

        ];

        foreach ($branches as $branch) {
            foreach ($branch["employees"] as $employee) {
                $user = new User();
                $user->name = $employee['name'];
                $user->email = $employee['email'];
                $user->phone = $employee['phone'];
                $user->password = bcrypt("password");
                $user->type = "services_employee";
                $user->save();

                $new_employee = new Employee();
                $new_employee->branch_id = $employee["branch_id"];
                $new_employee->user_id = $user->id;
                $new_employee->window_id = $employee["window_id"];
                $new_employee->save();

                $employee_services = new Employee_service();
                $employee_services->employee_id = $new_employee->id;
                $employee_services->service_id = $employee["service_id"];
                $employee_services->save();
            }
        }

    }
}
