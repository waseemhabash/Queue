<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function privileges()
    {
        return $this->belongsToMany("App\Models\Privilege","role_privileges","role_id","privilege_id");
    }
}
