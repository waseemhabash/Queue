<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsEmployee extends Model
{
    public function branch()
    {
        return $this->belongsTo("App\Models\Branch");
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id");
    }

    public static function store_employee($branch_id)
    {

        $user = User::create_user("tickets_employee");

        $employee = new TicketsEmployee();
        $employee->branch_id = $branch_id;
        $employee->user_id = $user->id;
        $employee->save();

        return $employee;
    }

    public static function update_employee($employee)
    {

        $user = User::update_user($employee->user);

        return $employee;
    }
}
