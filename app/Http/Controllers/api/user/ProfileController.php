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
        $reservations = Reservation::with(["service","service.images","service.branch","service.branch.company"])->where('user_id', $user->id)->whereDate("created_at", Carbon::today())->get();
    
        res([
            "profile" => $user,
            "reservations" => $reservations,
        ]);
        exit;
    }

    public function update_profile()
    {
        $user = userFromToken();

        $user->image = upload_file("image", "assets/uploads/users/$user->id/");
        $user->update();

        res($user);
        exit;
    }

}
