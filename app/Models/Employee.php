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

    public function serve($service_id)
    {
        return $this->services->find($service_id);
    }

    public function window()
    {
        return $this->belongsTo("App\Models\Window", "window_id");
    }
    public function queue()
    {
        return $this->hasMany("App\Models\Queue")->orderByDesc("id");
    }
    public function temp_callings()
    {
        return $this->hasMany("App\Models\Temp_calling");
    }

    public function calledAndNotServed()
    {
        return $this->queue()->whereNull("start_served")->first();
    }

    public function startServedButNotFinished()
    {
        return $this->queue()->whereNotNull("start_served")->whereNull("end_served")->first();
    }

    public static function store_employee($branch_id)
    {
        request()->validate([
            "services" => "required",
            "services.*" => "exists:services,id",
            "window" => "required|exists:windows,id",
        ]);

        $user = User::create_user("services_employee");

        $employee = new Employee();
        $employee->branch_id = $branch_id;
        $employee->user_id = $user->id;
        $employee->window_id = request("window");
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
        request()->validate([
            "services" => "required",
            "services.*" => "exists:services,id",
            "window" => "required|exists:windows,id",
        ]);
        $user = User::update_user($employee->user);

        if (request("window") != $employee->window_id) {
            $employee->active = 0;
        }

        $employee->window_id = request("window");
        $employee->update();

        $employee->services()->detach();

        foreach (request("services") as $service_id) {
            $employee_services = new Employee_service();
            $employee_services->employee_id = $employee->id;
            $employee_services->service_id = $service_id;
            $employee_services->save();
        }

        return $employee;
    }

    public function next_in_queue($current_queue = false)
    {

        if ($next = $this->calledAndNotServed()) {
            return $next;
        }

        if (!$current_queue) {
            $current_queue = $this->branch->current_queue();
        }

        $current_queue_services = $current_queue->pluck("service_id")->unique();

        $next_service = $this->services->whereIn("id", $current_queue_services)->first();

        $key = $current_queue->search(function ($queue) use ($next_service) {
            return $queue->service_id == $next_service->id;
        });

        if (!is_numeric($key)) {
            return null;
        }

        $next_in_queue = $current_queue[$key];

        if (is_null($next_in_queue->employee_id)) {
            return $next_in_queue;
        } elseif ($next_in_queue->employee_id == $this->id) {
            return $next_in_queue;
        } else { // $next_in_queue->employee_id != $this->id
            $current_queue->forget($key);
            return $this->next_in_queue($current_queue);
        }

    }
    
}
