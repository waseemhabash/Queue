<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function branch()
    {
        return $this->belongsTo("App\Models\Branch", "branch_id");
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id");
    }
    public function services()
    {
        return $this->belongsToMany("App\Models\Service", "employee_services", "employee_id", "service_id");
    }

    public static function store_employee($branch_id)
    {
        request()->validate([
            "services" => "required",
            "services.*" => "exists:services,id",
        ]);

        $user = User::create_user("services_employee");

        $employee = new Employee();
        $employee->branch_id = $branch_id;
        $employee->user_id = $user->id;
        $employee->save();

        foreach (request("services") as $service_id) {
            $employee_services = new Employee_service();
            $employee_services->employee_id = $employee->id;
            $employee_services->service_id = $service_id;
            $employee_services->save();
        }

        return $employee;
    }

    public static function update_employee($employee)
    {
        $user = User::update_user($employee->user);

        return $employee;
    }
}
