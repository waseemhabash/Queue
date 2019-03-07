<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Window extends Model
{
    public function branch()
    {
        return $this->belongsTo("App\Models\Branch", "branch_id");
    }
}
