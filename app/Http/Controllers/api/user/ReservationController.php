<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Queue;
use App\Models\Reservation;
use App\Models\Service;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function reservation()
    {
        $user = userFromToken();
        validate([
            "service_id" => "required|exists:services,id",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
        ]) ?? exit;

        $service = Service::find(request("service_id"));
        $branch = $service->branch;

        $close_time = Carbon::parse($branch->close_time);
        $open_time = Carbon::parse($branch->open_time);

        if (Carbon::now()->gt($close_time)) {
            error_res([
                "message" => "هذا الفرع مغلق الآن",
            ]);
            exit;
        }

        $destination = calculate_distance_time(request("lat"), request("lng"), $branch->lat, $branch->lng);

        $queue_time = Queue::expected_time($branch, $service->id);

        $expected_time = Carbon::now()->addMinutes(max($destination["time"], $queue_time));

        if ($expected_time->lt($close_time->subMinute(30))) {

            $expected_time = $expected_time->lt($open_time) ? $open_time : $expected_time;

            while (Reservation::where("service_id", $service->id)->whereTime("expectedTime", $expected_time->format("H:i"))->whereDate('created_at', Carbon::today())->count() > 3) {
                $expected_time = $expected_time->addMinute(1);
            }

            res([
                "expected_time" => $expected_time->format("H:i"),
            ]);
            exit;

        } else {
            error_res([
                "message" => "تجاوز هذا الفرع الحد الأقصى",
            ]);
            exit;
        }

        exit;
    }

    public function confirm_reservation()
    {
        $user = userFromToken();
        validate([
            "service_id" => "required|exists:services,id",
            "lng" => "required|numeric",
            "lat" => "required|numeric",
        ]) ?? exit;

        $service = Service::find(request("service_id"));
        $branch = $service->branch;

        $close_time = Carbon::parse($branch->close_time);
        $open_time = Carbon::parse($branch->open_time);

        if (Carbon::now()->gt($close_time)) {
            error_res([
                "message" => "هذا الفرع مغلق الآن",
            ]);
            exit;
        }

        $destination = calculate_distance_time(request("lat"), request("lng"), $branch->lat, $branch->lng);

        $queue_time = Queue::expected_time($branch, $service->id);

        $expected_time = Carbon::now()->addMinutes(max($destination["time"], $queue_time));

        if ($expected_time->lt($close_time->subMinute(30))) {

            $expected_time = $expected_time->lt($open_time) ? $open_time : $expected_time;

            while (Reservation::where("service_id", $service->id)->whereTime("expectedTime", $expected_time->format("H:i"))->whereDate('created_at', Carbon::today())->count() > 3) {
                $expected_time = $expected_time->addMinute(1);
            }

            if ($old_reservation = Reservation::where("user_id", $user->id)->where("service_id", $service->id)->whereDate('created_at', Carbon::today())->first()) {
                error_res([
                    "message" => " قد قمت بحجز هذه الخدمة في الوقت :" . $old_reservation->expectedTime,
                ]);
                exit;
            }
            $reservation = new Reservation();
            $reservation->service_id = $service->id;
            $reservation->user_id = $user->id;
            $reservation->barcode = str_random(15);
            $reservation->expectedTime = $expected_time->format("H:i");
            $reservation->save();

            res([
                "reservation" => $reservation,
            ]);

            exit;
        } else {
            error_res([
                "message" => "تجاوز هذا الفرع الحد الأقصى",
            ]);
            exit;
        }

        exit;

    }

    public function extend_reservation()
    {
        $user = userFromToken();
        validate([
            "reservation_id" => "required|exists:reservations,id",
            "extra_minutes" => "required|integer",
        ]) ?? exit;

        $reservation = Reservation::find(request("reservation_id"));
        $new_time = Carbon::parse($reservation->expectedTime)->addMinutes(request("extra_minutes"));
        $close_time = Carbon::parse($reservation->service->branch->close_time);

        if ($new_time->gt($close_time)) {
            error_res([
                "message" => "هذا الفرع مغلق الآن",
            ]);
            exit;
        }

        if ($new_time->lt($close_time->subMinute(30))) {

            res([
                "expected_time" => $new_time->format("H:i"),
            ]);
            exit;

        } else {
            error_res([
                "message" => "تجاوز هذا الفرع الحد الأقصى",
            ]);
            exit;
        }

        res([
            "message" => "تم الحذف بنجاح",
        ]);
        exit;
    }

    public function delete_reservation()
    {
        $user = userFromToken();
        validate([
            "reservation_id" => "required|exists:reservations,id",
        ]) ?? exit;

        Reservation::destroy(request("reservation_id"));
        res([
            "message" => "تم الحذف بنجاح",
        ]);
        exit;
    }

}
