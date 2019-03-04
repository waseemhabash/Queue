<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    public static function get_by_name($privilege_name)
    {
        return Privilege::where("name",$privilege_name)->first();
    }
}
