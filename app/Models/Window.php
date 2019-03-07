<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Window extends Model
{
    public function branch()
    {
        return $this->belongsTo("App\Models\Branch", "branch_id");
    }

    public static function store_window($branch_id)
    {
        request()->validate([
            "name" => "required|alpha|max:1",
        ]);

        $window = new Window();
        $window->prefix = strtoupper(request("name"));
        $window->branch_id = $branch_id;
        $window->save();
    }

    public static function update_window($window)
    {
        request()->validate([
            "name" => "required|alpha|max:1",
        ]);

        $window->prefix = strtoupper(request("name"));
        $window->update();
    }
}
