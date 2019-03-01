<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    public function manger()
    {
        return $this->belongsTo("App\Models\Branch_manger", "branch_manger_id")->with("user");
    }

    public function user()
    {
        return $this->manger->user;
    }

    public static function create_branch()
    {

        $user = User::create_user("branch_manger");

        request()->validate([
            "name" => "required",
            "address" => "required",
            "description" => "required",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
        ]);

        $branch_manger = new Branch_manger();
        $branch_manger->user_id = $user->id;
        $branch_manger->save();

        $branch = new Branch();
        $branch->name = request("name");
        $branch->address = request("address");
        $branch->description = request("description");
        $branch->lng = request("lng");
        $branch->lat = request("lat");
        $branch->company_id = session("company_id");
        $branch->branch_manger_id = $branch_manger->id;
        $branch->save();

        return $branch;
    }
}
