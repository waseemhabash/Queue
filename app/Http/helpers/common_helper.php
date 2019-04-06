<?php

function c_page($pages)
{
    if (is_string($pages)) {
        $pages = [$pages];
    }

    $bool = false;
    foreach ($pages as $page) {
        $bool = $bool || session("c_page") == $page;
    }

    return $bool ? "active open" : "";
}

function selected($value1, $value2)
{
    return ($value1 == $value2) ? "selected" : "";
}

function upload_file($file, $path, $old_file = false)
{
    if (is_string($file)) {
        $file = request($file);

        if (is_null($file)) {
            return null;
        }
    }

    if ($old_file) {
        del_file($old_file);
    }

    $file_extension = $file->getClientOriginalExtension();
    $file_name = "QueueLines_" . str_random(4) . "." . $file_extension;
    while (file_exists(public_path($path . $file_name))) {
        $file_name = "QueueLines_" . str_random(4) . "." . $file_extension;
    }

    $file->move(public_path($path), $file_name);

    return ($path . $file_name);

}

function del_file($path)
{
    if (file_exists(public_path($path))) {
        @unlink(public_path($path));
    }
}

function hash_page($hash)
{
    return session("hash") == $hash ? "active in" : "";
}

function user_type()
{
    return auth()->user()->type;
}

function is_type($types)
{
    if (is_string($types)) {
        $types = [$types];
    }

    return in_array(user_type(), $types);
}
