<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $hidden = ["password", "remember_token"];

    public function company()
    {
        return $this->hasOne("App\Models\Company", "user_id");
    }
    public function reservations()
    {
        return $this->hasMany("App\Models\Reservation")->whereDate("created_at", Carbon::today());
    }

    public function favorites()
    {
        return $this->belongsToMany("App\Models\Service", "favorites");
    }

    public function branch()
    {
        return $this->hasOne("App\Models\Branch", "user_id");
    }

    public function ticketsEmployee()
    {
        return $this->hasOne("App\Models\TicketsEmployee", "user_id");

    }

    public function employee()
    {
        return $this->hasOne("App\Models\Employee", "user_id");

    }

    public function devices()
    {
        return $this->hasMany("App\Models\Device");
    }

    public static function create_user($type)
    {
        request()->validate([
            "username" => "required",
            "email" => "required|email|unique:users,email",
            "phone" => "required|unique:users,phone",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
        ]);

        $user = new User();
        $user->name = request("username");
        $user->email = request("email");
        $user->phone = request("phone");
        $user->password = bcrypt(request("password"));
        $user->type = $type;
        $user->save();

        return $user;
    }

    public static function update_user($user)
    {
        request()->validate([
            "username" => "required",
            "email" => "required|email|unique:users,email,$user->id",
            "phone" => "required|unique:users,phone,$user->id",
            "password" => "sometimes|nullable|confirmed",
        ]);

        $user->name = request("username");
        $user->email = request("email");
        $user->phone = request("phone");

        if (request("password")) {
            $user->password = bcrypt(request("password"));
        }

        $user->update();

        return $user;
    }

    public function routeNotificationForOneSignal()
    {
        return $this->devices->pluck("notify_token")->toArray();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
