<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function branch()
    {
        return $this->belongsTo("App\Models\Branch", "branch_id");
    }

    public function employees()
    {
        return $this->belongsToMany("App\Models\Employee", "employee_services", "service_id", "employee_id");
    }

    public static function store_service($branch_id)
    {
        request()->validate([
            "name" => "required",
            "description" => "required",
            "timeInMinutes" => "required|numeric",
            "requirements" => "required",
        ]);

        $service = new Service();
        $service->name = request("name");
        $service->description = request("description");
        $service->time = request("timeInMinutes");
        $service->requirements = request("requirements");
        $service->branch_id = $branch_id;
        $service->save();
        return $service;

    }

    public static function update_service($service)
    {
        request()->validate([
            "name" => "required",
            "description" => "required",
            "timeInMinutes" => "required|numeric",
        ]);

        $service->name = request("name");
        $service->description = request("name");
        $service->time = request("timeInMinutes");
        $service->requirements = request("requirements");
        $service->update();

        return $service;
    }
}
