<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favorites()
    {
        $user = userFromToken();
        res([
            "favorites" => $user->favorites,
        ]);
        exit;
    }

    public function make_favorite()
    {

        validate([
            "service_id" => "required|exists:services,id",
        ]) ?? exit;

        $user = userFromToken();
        $favorite = new Favorite();
        $favorite->service_id = request("service_id");
        $favorite->user_id = $user->id;
        $favorite->save();

        res();
        exit;
    }

    public function unmake_favorite()
    {
        validate([
            "service_id" => "required|exists:services,id",
        ]) ?? exit;

        $user = userFromToken();

        Favorite::where("service_id",request("service_id"))->where("user_id",$user->id)->delete();

        res([]);
    }
}
