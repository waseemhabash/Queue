<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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

    public function company()
    {
     return $this->hasOne('App\Models\Company');
    }
}
