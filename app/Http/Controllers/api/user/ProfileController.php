<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function get_profile()
    {
        $user = userFromToken();

        res([
            "profile" => $user,
        ]);
        exit;
    }

    public function update_profile()
    {

    }
}
