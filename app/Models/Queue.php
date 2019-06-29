<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    public function service()
    {
        return $this->belongsTo("App\Models\Service");
    }
    public function employee()
    {
        return $this->belongsTo("App\Models\Employee");
    }

    public function customer()
    {
        return $this->belongsTo("App\Models\User", "customer_id");
    }

    public function rate()
    {
        return $this->hasOne("App\Models\Rate");
    }

    public static function expected_time($branch, $service_id)
    {
        $current_employees = $branch->current_employees();

        $current_queue = $branch->current_queue()->reject(function ($queue) use ($current_employees, $service_id) {

            if ($queue->priority == 3) {
                return true;
            }

            foreach ($current_employees as $employee) {
                if ($employee->services->find($service_id) && $employee->services->find($queue->service_id)) {
                    return false;
                }
            }

            return true;
        });

        while ($current_queue->isNotEmpty()) {

            $current_queue_services = $current_queue->pluck("service_id")->unique();

            $employees_has_services_in_queue = $current_employees->filter(function ($employee) use ($current_queue_services) {
                return $employee->services->whereIn("id", $current_queue_services)->isNotEmpty();
            });

            if (!$employees_has_services_in_queue) {
                break;
            }

            $next_employee = $employees_has_services_in_queue->firstWhere("servicing_time", $employees_has_services_in_queue->min("servicing_time"));

            $next_service = $next_employee->services->whereIn("id", $current_queue_services)->first();

            $current_employees->map(function ($employee) use ($next_employee, $next_service) {
                if ($employee->id == $next_employee->id) {
                    $employee->servicing_time += $next_service->time;
                }
                return $employee;
            });

            $key = $current_queue->search(function ($queue) use ($next_service) {
                return $queue->service_id == $next_service->id;
            });

            $current_queue->forget($key);

        }

        return $current_employees->max("servicing_time");
    }
}
