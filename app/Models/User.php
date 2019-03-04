<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function company()
    {
        return $this->hasOne("App\Models\Company","user_id");
    }

    public function roles()
    {
        return $this->belongsToMany("App\Models\Role", "role_users", "user_id", "role_id");
    }

    public function privileges()
    {
        $roles = $this->roles;
        $privileges = [];

        foreach ($roles as $role) {
            foreach ($role->privileges as $priv) {
                if (!in_array($priv->name, $privileges)) {
                    $privileges[] = $priv->name;
                }
            }
        }
        return $privileges;
    }

    public function has_priv($privileges)
    {
        $bool = false;
        $user_privileges = session("privileges");

        if (is_string($privileges)) {
            $bool = $bool || in_array($privileges, $user_privileges);

        } else {
            foreach ($privileges as $priv) {
                $bool = $bool || in_array($priv, $user_privileges);
            }
        }

        return $bool;
    }

    public function has_role($role_id)
    {
        return $this->roles->find($role_id);
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

}
