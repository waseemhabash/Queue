<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

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

        $role = Role::get_by_name("فرع");
        request()->request->add(["roles" => [$role->id]]);
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
