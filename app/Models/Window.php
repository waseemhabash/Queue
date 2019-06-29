<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Window extends Model
{
    public function branch()
    {
        return $this->belongsTo("App\Models\Branch", "branch_id");
    }

    public function employees()
    {
        return $this->hasMany("App\Models\Employee");
    }

    public function employee()
    {
        return $this->employees()->where("active", 1)->first();
    }

    public static function store_window()
    {
        $branch = myBranch();
        request()->validate([
            "name" => "required|integer|max:399",
        ]);

        $window = new Window();
        $window->prefix = request("name");
        $window->branch_id = $branch->id;
        $window->save();
    }

    public static function update_window($window)
    {
        request()->validate([
            "name" => "required|integer|max:399",
        ]);

        $window->prefix = request("name");
        $window->update();
    }
}
