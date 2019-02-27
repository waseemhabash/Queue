<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Company extends Model
{
    public function owner($id)
    {
    	$user= User::find($id)->first();
        return $user->name;
    }
}
