<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;
class ProfileController extends Controller
{
    public function get_profile()
    {
        $user = userFromToken();
        $reservations= Reservation::where('user_id',$user->id)->whereDate("created_at",Carbon::today())->get();
     
        res([
           
            "profile" => $user,
            "reservations" => $reservations,
        ]);
        exit;
    }

    
}
