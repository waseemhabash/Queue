<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $appends = ['destination'];

    public function getDestinationAttribute()
    {
        $lng = request("lng");
        $lat = request("lat");
        $transport = request("transport");

        $url = "https://api.mapbox.com/directions/v5/mapbox/$transport/$lng,$lat;$this->lng,$this->lat?access_token=pk.eyJ1Ijoid2FzZWVtYWxoYWJhc2giLCJhIjoiY2pzcWo3MmgyMTRlNTQ0bzQ1MWMyOGtzZSJ9.Hk7_kl2Oh9TH-i8513BV1g";

        $response = curl($url);

        $time = $response['routes'][0]['duration'];
        $dist = $response['routes'][0]['distance'];

        return ['distance' => $dist, 'time' => $time];

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

    public static function create_branch($company_id)
    {

        request()->validate([
            "name" => "required",
            "address" => "required",
            "description" => "required",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
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
        ]);

        $user = User::update_user($branch->user);

        $branch->name = request("name");
        $branch->address = request("address");
        $branch->description = request("description");
        $branch->lng = request("lng");
        $branch->lat = request("lat");
        $branch->update();
    }
}
