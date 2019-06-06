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

    public function get_services(){
        $user = userFromToken();

        res([
        "services"=>$user->ticketsEmployee->branch->services
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

        if ($reservation) {

            if ($reservation->service->branch_id != $user->ticketsEmployee->branch_id) {
                error_res([
                    "message" => "هذا الباركود يجب أن يمسح في غير مركز " . $reservation->service->branch->name,
                ]);
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

            //$reservation->delete();
        } else {
            error_res([
                "message" => "الباركود غير صحيح",
            ]);
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

        res([
            "message" => "تم الإضافة للدور بنجاح",
        ]);

        exit;

        //$reservation->delete();
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
                ]);
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
