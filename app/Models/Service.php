<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function branch()
    {
        return $this->belongsTo("App\Models\Branch", "branch_id");
    }

    public static function store_service($branch_id)
    {
        request()->validate([
            "name" => "required",
            "description" => "required",
            "timeInMinutes" => "required|numeric",
        ]);

        $service = new Service();
        $service->name = request("name");
        $service->description = request("name");
        $service->time = request("timeInMinutes");
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
        $service->update();

        return $service;
    }
}
