<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public function manger()
    {
        return $this->belongsTo("App\Models\Company_manger", "company_manger_id")->with("user");
    }

    public function user()
    {
        return $this->manger->user;
    }
    public function branches()
    {
        return $this->hasMany("App\Models\Branch");
    }

    public static function create_company()
    {
        $user = User::create_user("company_manger");

        $company_manger = new Company_manger();
        $company_manger->user_id = $user->id;
        $company_manger->save();

        request()->validate([
            "name" => "required",
            "description" => "required",
            "logo" => "required|image",
        ]);

        $company = new Company();
        $company->name = request("name");
        $company->description = request("description");
        $company->logo = upload_file("logo", "uploads/companies/$user->id/");
        $company->company_manger_id = $company_manger->id;
        $company->save();

        return $company;
    }

    public static function update_company($company)
    {
        $user = User::update_user($company->user());

        request()->validate([
            "name" => "required",
            "description" => "required",
            "logo" => "sometimes|nullable|image",
        ]);

        $company->name = request("name");
        $company->description = request("description");

        if (request("logo")) {
            del_file($company->logo);
            $company->logo = upload_file("logo", "uploads/companies/$user->id/");
        }
        $company->update();

        return $company;
    }
}
