<?php
use GuzzleHttp\Client;

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

    if (!auth()->check()) {
        return false;
    }
    if (is_string($types)) {
        $types = [$types];
    }

    return in_array(user_type(), $types);
}

function calculate_distance_time($lat1, $lng1, $lat2, $lng2)
{
    $pi80 = M_PI / 180;
    $lat1 *= $pi80;
    $lng1 *= $pi80;
    $lat2 *= $pi80;
    $lng2 *= $pi80;

    $r = 6372.797;
    $dlat = $lat2 - $lat1;
    $dlng = $lng2 - $lng1;
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $meters = $r * $c * 1000;

    return ['distance' => round($meters), 'time' => round($meters * 0.015)];
}

function order_by_distance($lat, $lng)
{
    return "( 6371 * ACOS( COS( RADIANS( '$lat' ) ) * COS( RADIANS( branches.lat ) ) * COS( RADIANS( branches.lng ) - RADIANS( '$lng' ) ) + SIN( RADIANS( '$lat' ) ) * SIN( RADIANS( branches.lat))))";
}

function update_queue($branch)
{
    try {
        $client = new Client();
        $client->post("localhost:3000/update_queue", [
            "form_params" => [
                "branch_id" => $branch->id,
                "queue" => json_encode($branch->current_queue(10)),
            ],
        ]);
    } catch (\Throwable $th) {
    }

}

function get_voice($name)
{
    return file_get_contents(storage_path("voices/$name.mp3"));
}

function calling($queue_number, $window_number, $branch_id,$wait)
{

    $queue_number_voice = get_voice($queue_number);
    $window_number_voice = get_voice($window_number);
    $window_voice = get_voice("window");
    $number_voice = get_voice("number");

    $full_voice_file_data = $number_voice . $queue_number_voice . $window_voice . $window_number_voice;
    $full_voice_file_link = public_path("calling/$queue_number-$window_number.mp3");
    file_put_contents($full_voice_file_link, $full_voice_file_data);

    $client = new Client();
    $client->post("localhost:3000/calling", [
        "form_params" => [
            "full_voice_file_link" => url("calling/$queue_number-$window_number.mp3"),
            "branch_id" => $branch_id,
            "number" => $queue_number,
            "window" => $window_number,
            "wait" => $wait
        ],
    ]);

}


function myCompany()
{
    return auth()->user()->company;
}

function myBranch()
{
    return auth()->user()->branch;
}

function myEmployee()
{
    return auth()->user()->employee;
}
