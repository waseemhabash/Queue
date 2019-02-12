<?php
use App\Models\User;

function c_page($pages)
{
    $bool = false;
    foreach ($pages as $page) {
        $bool = $bool || session("c_page") == $page;
    }

    return $bool ? "active open" : "";
}

function login_user()
{
    $user_id = auth()->id();
    $user = User::find($user_id);
    return $user;
}

function upload_file($file, $path)
{

    if (is_string($file)) {
        $file = request($file);

        if (is_null($file)) {
            return null;
        }
    }

    $file_name = str_random(4) . "_" . $file->getClientOriginalName();

    $file->move(public_path($path), $file_name);

    return ($path . $file_name);

}
