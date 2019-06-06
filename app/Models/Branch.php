<?php

namespace App\Models;

use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $appends = ['destination', "closed"];

    public function getDestinationAttribute()
    {

        $lng = request("lng");
        $lat = request("lat");

        if (!$lat || !$lng) {
            return ["message" => "lat and lng is required"];
        }

        return calculate_distance_time($this->lat, $this->lng, $lat, $lng);

    }

    public function getClosedAttribute()
    {
        $close_time = Carbon::parse($this->close_time);

        return Carbon::now()->gt($close_time);

    }

    public function current_queue()
    {
        $current_queue = Queue::whereHas("service", function ($service) {
            $service->where("branch_id", $this->id);
        })
            ->whereDate('created_at', Carbon::today())
            ->where("served", 0)
            ->orderBy("priority")
            ->orderBy("id")
            ->get();

        return $current_queue;
    }

    public function current_employees()
    {
        return $this->windows->map(function ($window) {
            $employee = $window->employee();

            if ($employee) {
                $employee->servicing_time = 0;
            }

            return $employee;
        })->reject(function ($employee) {
            return !$employee;
        });

    }

    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id");
    }

    public function company()
    {
        return $this->belongsTo("App\Models\Company", "company_id");
    }

    public function services()
    {
        return $this->hasMany("App\Models\Service", "branch_id");
    }

    public function windows()
    {
        return $this->hasMany("App\Models\Window", "branch_id");
    }

    public function employees()
    {
        return $this->hasMany("App\Models\Employee", "branch_id");

    }

    public function tickets_employees()
    {
        return $this->hasMany("App\Models\TicketsEmployee", "branch_id");
    }

    public static function create_branch($company_id)
    {

        request()->validate([
            "name" => "required",
            "address" => "required",
            "description" => "required",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
            "openTime" => "required",
            "closeTime" => "required",
        ]);

        $user = User::create_user("branch_manager");

        $branch = new Branch();
        $branch->name = request("name");
        $branch->address = request("address");
        $branch->description = request("description");
        $branch->lng = request("lng");
        $branch->lat = request("lat");
        $branch->company_id = $company_id;
        $branch->user_id = $user->id;
        $branch->close_time = request("closeTime");
        $branch->open_time = request("openTime");
        $branch->save();

        return $branch;
    }

    public static function update_branch($branch)
    {

        request()->validate([
            "name" => "required",
            "address" => "required",
            "description" => "required",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
            "openTime" => "required",
            "closeTime" => "required",
        ]);

        $user = User::update_user($branch->user);

        $branch->name = request("name");
        $branch->address = request("address");
        $branch->description = request("description");
        $branch->lng = request("lng");
        $branch->lat = request("lat");
        $branch->close_time = request("closeTime");
        $branch->open_time = request("openTime");
        $branch->update();
    }
}
