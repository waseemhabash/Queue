<?php

namespace App\Models;

use App\Models\Queue;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $appends = ['destination', "opened"];

    public function getDestinationAttribute()
    {

        $lng = request("lng");
        $lat = request("lat");

        if (!$lat || !$lng) {
            return ["message" => "lat and lng is required"];
        }

        return calculate_distance_time($this->lat, $this->lng, $lat, $lng);

    }

    public function getOpenedAttribute()
    {
        $open_time = Carbon::parse($this->open_time);
        $close_time = Carbon::parse($this->close_time);

        return Carbon::now()->lt($close_time) && Carbon::now()->gt($open_time);

    }

    public function temp_callings()
    {
        return $this->hasMany("App\Models\Temp_calling")->orderBy("id", "asc");
    }

    public function rate_avg()
    {
        $rate = 0;
        $count = 0;
        $customers = Queue::whereHas("service", function ($service) {
            $service->where("branch_id", $this->id);
        })->get();

        foreach ($customers as $customer) {
            if ($customer->rate) {

                $rate += $customer->rate->rate;
                $count++;
            }
        }

        return $rate == 0 ? 0 : $rate / $count;
    }

    public function current_queue($limit = false)
    {
        $current_queue = Queue::with(["service", "employee.window"])->whereHas("service", function ($service) {
            $service->where("branch_id", $this->id);
        })
            ->whereDate('created_at', Carbon::today())
            ->whereNull("start_served")
            ->orderByRaw('ISNULL(employee_id), employee_id')
            ->orderBy("priority")
            ->orderBy("id");

        if ($limit) {
            $current_queue = $current_queue->limit($limit);
        }

        return $current_queue->get();
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
        return $this->hasMany("App\Models\Employee", "branch_id")->with("user");
    }

    public function tickets_employees()
    {
        return $this->hasMany("App\Models\TicketsEmployee", "branch_id");
    }

    public static function create_branch()
    {
        $company = myCompany();
        request()->validate([
            "name" => "required",
            "address" => "required",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
            "image" => "required|image",
            "openTime" => "required",
            "closeTime" => "required",
            "minutes_before_closing" => "required|integer",
        ]);

        $user = User::create_user("branch_manager");

        $branch = new Branch();
        $branch->name = request("name");
        $branch->address = request("address");
        $branch->lng = request("lng");
        $branch->lat = request("lat");
        $branch->company_id = $company->id;
        $branch->user_id = $user->id;
        $branch->image = upload_file("image", "assets/uploads/branches/$user->id/");
        $branch->close_time = request("closeTime");
        $branch->open_time = request("openTime");
        $branch->minutes_before_closing = request("minutes_before_closing");
        $branch->save();

        return $branch;
    }

    public static function update_branch($branch)
    {

        request()->validate([
            "name" => "required",
            "address" => "required",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
            "image" => "image",
            "openTime" => "required",
            "closeTime" => "required",
            "minutes_before_closing" => "required|integer",
        ]);

        $user = User::update_user($branch->user);

        $branch->name = request("name");
        $branch->address = request("address");
        $branch->lng = request("lng");
        $branch->lat = request("lat");
        $branch->image = upload_file("image", "assets/uploads/branches/$user->id/") ?? $branch->image;
        $branch->close_time = request("closeTime");
        $branch->open_time = request("openTime");
        $branch->minutes_before_closing = request("minutes_before_closing");
        $branch->update();
    }
}
