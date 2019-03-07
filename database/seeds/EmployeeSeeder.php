<?php

use App\Models\Employee;
use App\Models\User;
use App\Models\Employee_service;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{

    public function run()
    {
        $user = new User();
        $user->name = "Employee Manager";
        $user->email = "Employee@email.com";
        $user->phone = "09888564232";
        $user->password = bcrypt("password");
        $user->type = "services_employee";
        $user->save();

        $employee = new Employee();
        $employee->branch_id = 1;
        $employee->user_id = $user->id;
        $employee->save();

        $employee_services = new Employee_service();
        $employee_services->employee_id = $employee->id;
        $employee_services->service_id = 1;
        $employee_services->save();
    }
}
