<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public function user()
    {
        return $this->belongsTo("App\Models\user", "user_id");
    }
    public function branches()
    {
        return $this->hasMany("App\Models\Branch", "company_id");
    }

    public function all_customers()
    {
        $customers = Queue::whereHas("service", function ($branch) {
            $branch->whereIn("branch_id", $this->branches->pluck("id"));
        })->get();

        return $customers;

    }

    public static function create_company()
    {

        $user = User::create_user("company_manager");

        request()->validate([
            "name" => "required",
            "description" => "required",
            "logo" => "required|image",
        ]);

        $company = new Company();
        $company->name = request("name");
        $company->description = request("description");
        $company->logo = upload_file("logo", "assets/uploads/companies/$user->id/");
        $company->user_id = $user->id;
        $company->save();

        return $company;
    }

    public static function update_company($company)
    {
        $user = User::update_user($company->user);

        request()->validate([
            "name" => "required",
            "description" => "required",
            "logo" => "sometimes|nullable|image",
        ]);

        $company->name = request("name");
        $company->description = request("description");

        $company->logo = upload_file("logo", "assets/uploads/companies/$user->id/", $company->logo) ?? $company->logo;

        $company->update();

        return $company;
    }
}
