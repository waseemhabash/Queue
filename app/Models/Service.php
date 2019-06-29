<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Service extends Model
{

    protected $appends = ['IsFavorite'];

    public function getIsFavoriteAttribute()
    {
        $user = userFromToken();

        if($user)
        {
            $is_favorite = $user->favorites()->find($this->id);

            return $is_favorite ? true : false;
        }else
        {
            return false;
        }

        
    }

    public function avg_time()
    {
        $queues = $this->queues;

        $count = 0;
        $sum = 0;

        foreach ($queues as $queue) {
            if ($queue->end_served) {
                $start_served = Carbon::parse($queue->end_served);
                $end_served = Carbon::parse($queue->start_served);
                $sum += $end_served->diffInMinutes($start_served);
                $count++;
            }
        }
        return $sum == 0 ? 0 : $sum / $count;

    }

    public function branch()
    {
        return $this->belongsTo("App\Models\Branch", "branch_id");
    }

    public function employees()
    {
        return $this->belongsToMany("App\Models\Employee", "employee_services", "service_id", "employee_id");
    }

    public function images()
    {
        return $this->hasMany("App\Models\Service_image");
    }

    public function queues()
    {
        return $this->hasMany("App\Models\Queue");
    }

    public static function store_service()
    {
        $branch = myBranch();

        request()->validate([
            "name" => "required",
            "description" => "required",
            "timeInMinutes" => "required|numeric",
            "requirements" => "required",
            "images" => "required",
            "images.*" => "image",
        ]);

        $service = new Service();
        $service->name = request("name");
        $service->description = request("description");
        $service->time = request("timeInMinutes");
        $service->requirements = request("requirements");
        $service->branch_id = $branch->id;
        $service->save();

        foreach (request("images") as $image) {
            $service_image = new Service_image();
            $service_image->path = upload_file($image, "assets/uploads/branches/" . $service->branch->user->id . "/services/");
            $service_image->service_id = $service->id;
            $service_image->save();
        }

        return $service;

    }

    public static function update_service($service)
    {
        request()->validate([
            "name" => "required",
            "description" => "required",
            "timeInMinutes" => "required|numeric",
            "images.*" => "image",
        ]);

        $service->name = request("name");
        $service->description = request("name");
        $service->time = request("timeInMinutes");
        $service->requirements = request("requirements");
        $service->update();

        foreach (request("images") ?? [] as $image) {
            $service_image = new Service_image();
            $service_image->path = upload_file($image, "assets/uploads/branches/" . $service->branch->user->id . "/services/");
            $service_image->service_id = $service->id;
            $service_image->save();
        }
        return $service;
    }
}
