<?php

namespace App\Http\Controllers\api\tickets_employee;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\Reservation;
use App\Models\Service;
use Carbon\Carbon;
use JWTAuth;

class MainController extends Controller
{

    public function get_services()
    {
        $user = userFromToken();

        res([
            "services" => $user->ticketsEmployee->branch->services()->with("images")->get(),
        ]);

        exit;
    }
    public function online_queue()
    {

        $user = userFromToken();

        validate([
            "barCode" => "required",
        ]) ?? exit;

        $reservation = Reservation::with("service")->where("barcode", request("barCode"))->whereDate('created_at', Carbon::today())->first();
        $service = $reservation->service;
        $branch = $service->branch;
        if ($reservation) {

            if ($service->branch_id != $user->ticketsEmployee->branch_id) {
                error_res([
                    "message" => "هذا الباركود يجب أن يمسح في غير مركز " . $branch->name,
                ], 502);
                exit;
            }

            $queue = new Queue();
            $queue->service_id = $reservation->service_id;
            $queue->customer_id = $reservation->user_id;

            $reservation_time = Carbon::parse($reservation->expectedTime);

            if (Carbon::now()->lte($reservation_time->addMinutes(5)) && Carbon::now()->gte($reservation_time->subMinutes(5))) {
                $queue->priority = 1;
            } else {
                $queue->priority = 2;
            }

            $maxNumber = Queue::where("priority", $queue->priority)->whereDate('created_at', Carbon::today())->whereHas("service.branch", function ($branch) use ($reservation) {
                $branch->where("id", $reservation->service->branch_id);
            })->latest()->first();

            if ($maxNumber && ($maxNumber->number != (($queue->priority + 1) * 100) - 1)) {
                $queue->number = $maxNumber->number + 1;
            } else {
                $queue->number = ($queue->priority * 100);
            }

            $queue->save();

            update_queue($branch);

            $reservation->delete();

            $message = "*****************************\n";
            $message .= "ً\tWelcome To QLines\n";
            $message .= "*****************************\n";
            $message .= "Your Number is : -- " . $queue->number . " -- \n";
            $message .= "Date : " . Carbon::now() . "\n";
            $message .= "*****************************";
            res([
                "message" => $message,
            ]);

        } else {
            error_res([
                "message" => "الباركود غير صحيح",
            ], 503);
            exit;
        }

    }
    public function normal_queue()
    {

        $user = userFromToken();

        validate([
            "service_id" => "required|exists:services,id",
        ]) ?? exit;

        $service = Service::find(request("service_id"));

        $branch = $service->branch;

        $queue = new Queue();
        $queue->service_id = request("service_id");

        $queue->priority = 3;

        $maxNumber = Queue::where("priority", $queue->priority)->whereDate('created_at', Carbon::today())->whereHas("service.branch", function ($branch) use ($service) {
            $branch->where("id", $service->branch_id);
        })->latest()->first();

        if ($maxNumber && ($maxNumber->number != (($queue->priority + 1) * 100) - 1)) {
            $queue->number = $maxNumber->number + 1;
        } else {
            $queue->number = ($queue->priority * 100);
        }

        $queue->save();

        update_queue($service->branch);

        $message = "*****************************\n";
        $message .= "ً\tWelcome To QLines\n";
        $message .= "*****************************\n";
        $message .= "Your Number is : -- " . $queue->number . " -- \n";
        $message .= "Date : " . Carbon::now() . "\n";
        $message .= "*****************************";
        res([
            "message" => $message,
        ]);

        exit;

    }

    public function login()
    {
        validate([
            "email" => "required|email|exists:users,email",
            "password" => "required",
        ]) ?? exit;

        if (auth()->attempt(["email" => request("email"), "password" => request("password")])) {

            if (auth()->user()->type != "tickets_employee") {
                error_res([
                    "message" => "غير مسموح لك باستخدام هذا التابع",
                ], 501);
                exit;
            }

            $token = JWTAuth::fromUser(auth()->user());

            res(['Authorization' => "Bearer " . $token], 200);

            exit;

        } else {

            error_res([
                "message" => "كلمة المرور أو الإيميل غير صحيحين",
            ]);

        }

        exit;

    }
}
