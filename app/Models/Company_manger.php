<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_manger extends Model
{
    public function user()
    {
        return $this->belongsTo("App\Models\User","user_id");
    }
}
